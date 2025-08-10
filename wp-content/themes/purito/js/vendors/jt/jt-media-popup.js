/**
 * Media Popup 플러그인
 *
 * @version 1.0.0
 * @since 2023-08-14
 * @author STUDIO-JT (KMS)
 *
 * @requires magesloaded.js
 * @requires gsap.min.js
 * @requires jt-media-popup.css
 *
 * @example
 * // Basic usage (Image) :
 * new JtMediaPopup( element );
 *
 * // Basic usage (Iframe) :
 * new JtMediaPopup( element, {
 *     type : 'iframe'
 * });
 *
 * // More options :
 * new JtMediaPopup( element, {
 *     type : 'image',
 *     image : {
 *         verticalFit: false
 *     },
 *     callbacks : {
 *         open: function(){
 *             console.log('open');
 *         }
 *     }
 * });
 */
class JtMediaPopup {

    /**
     * JtMediaPopup 생성
     *
     * @constructor
     * @param {HTMLElement} element - 팝업을 호출할 Element
     * @param {Object} [args] - Options
     * @param {string} [args.prefix='jt-mdp'] - 팝업에 추가되는 class를 설정합니다.
     * @param {string} [args.type='image'] - 팝업의 타입을 지정합니다. (지원 타입 : Image, Iframe)
     * @param {(string|boolean)} [args.delegate=false] - 하위 항목이 설렉터가 될 경우 지정합니다. 동적요소에 이벤트를 바인드할때 유용합니다.
     * @param {string} [args.customClass=''] - 팝업에 class를 추가합니다.
     * @param {boolean} [args.closeButton=true] - 닫기 버튼 유무를 지정합니다.
     * @param {string} [args.closeBuilder='<span class="sr-only">닫기</span><i><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M13.4,12l7.1,7.1l-1.4,1.4L12,13.4l-7.1,7.1l-1.4-1.4l7.1-7.1L3.5,4.9l1.4-1.4l7.1,7.1l7.1-7.1l1.4,1.4L13.4,12z" fill="black"/></svg></i>'] - 닫기 버튼 마크업을 지정합니다.
     * @param {boolean} [args.closeOnContentClick=false] - 사용자가 내용을 클릭하면 팝업을 닫습니다.
     * @param {Object} [args.image] - Image 타입 팝업 옵션
     * @param {boolean} [args.image.verticalFit=true] - 이미지를 영역의 수직으로 맞춥니다.
     * @param {Object} [args.iframe] - Iframe 타입 팝업 옵션
     * @param {Object} [args.iframe.patterns] - Iframe URL 패턴을 지정합니다. youtube, vimeo 패턴을 기본으로 지원합니다.
     * @param {Object} [args.callbacks] - 이벤트 콜백
     * @param {function} [args.callbacks.beforeOpen] - 팝업이 열리기 전 실행되는 콜백
     * @param {function} [args.callbacks.open] - 팝업이 열린 후 실행되는 콜백
     * @param {function} [args.callbacks.beforeClose] - 팝업이 닫히기 전 실행되는 콜백
     * @param {function} [args.callbacks.close] - 팝업이 닫힌 후 실행되는 콜백
     */
    constructor( element, args ) {

        if( typeof element == 'undefined' ) return; // Required

        const _this = this;

        _this.el     = element;
        _this.dialog = undefined;

        _this.options  = {
            prefix              : 'jt-mdp',
            type                : 'image',
            delegate            : false,
            customClass         : '',
            closeButton         : true,
            closeBuilder        : '<span class="sr-only">닫기</span><i><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M13.4,12l7.1,7.1l-1.4,1.4L12,13.4l-7.1,7.1l-1.4-1.4l7.1-7.1L3.5,4.9l1.4-1.4l7.1,7.1l7.1-7.1l1.4,1.4L13.4,12z" fill="black"/></svg></i>',
            closeOnContentClick : false,
            image               : {
                                    verticalFit             : true,
                                    verticalFitEventListener: true
                                },
            iframe              : {
                                    patterns : {
                                        youtube  : {
                                            index: 'youtube.com/',
                                            id   : 'v=',
                                            src  : 'https://www.youtube.com/embed/%id%?autoplay=1&playsinline=1&modestbranding=1&showinfo=0&rel=0'
                                        },
                                            vimeo : {
                                            index: 'vimeo.com/',
                                            id   : '/',
                                            src  : 'https://player.vimeo.com/video/%id%?autoplay=1&playsinline=1'
                                        }
                                    }
                                },
            callbacks           : {
                                    beforeOpen: function(){
                                        // Before open
                                    },
                                    open: function(){
                                        // After open
                                    },
                                    beforeClose: function(){
                                        // Before close
                                    },
                                    close: function(){
                                        // After close
                                    }
                                }
        };

        // 파라미터 확인
        if( typeof args != 'undefined' ) {
            for( const [key, value] of Object.entries(args) ) {
                if( typeof value === 'object' && value !== null ) {
                    if( typeof _this.options[key] === 'object' && _this.options[key] !== null ) {
                        _this.options[key] = { ..._this.options[key], ...value };
                    } else {
                        _this.options[key] = value;
                    }
                } else {
                    _this.options[key] = value;
                }
            }
        }

        // 리스너 할당
        _this.el.addEventListener('click', _this.openPopup.bind(_this), false);

    }



    /**
     * Popup 열기
     */
    openPopup( event ) {

        event.preventDefault();
        event.stopPropagation();

        const _this = this;

        _this.options.callbacks.beforeOpen(); // callback

        // 팝업
        _this.dialog = document.createElement('dialog');
        _this.dialog.classList.add(_this.options.prefix, `${_this.options.prefix}--${_this.options.type}`);
        _this.dialog.innerHTML = `<div class="${_this.options.prefix}__container">
                                      <div class="${_this.options.prefix}__content">
                                          <span class="${_this.options.prefix}__loading-spinner"></span>
                                      </div>
                                  </div>`;
        
        if( _this.options.customClass != '' ) {
            _this.dialog.classList.add( _this.options.customClass );
        }

        _this.dialog.addEventListener('click', function(e){
            _this.closePopup(e);
        });

        // 닫기버튼
        let closeButton = undefined;
        
        if( _this.options.closeButton ) {
            closeButton   = document.createElement('button');
            closeButton.classList.add(`${_this.options.prefix}__close`);
            closeButton.innerHTML = _this.options.closeBuilder;
        }

        // 컨텐츠
        let node          = undefined;
        let dialogContent = undefined;

        if( _this.options.delegate === false ) { // 정적요소

            node = _this.el;

        } else { // 동적요소

            if( event.target.tagName.toLowerCase() === _this.options.delegate || !!event.target.closest(_this.options.delegate) ) {
                node = ( event.target.tagName.toLowerCase() == _this.options.delegate ) ? event.target : event.target.closest(_this.options.delegate);
            }

        }

        if( node == undefined ) return;

        if( _this.options.type == 'image' ) {

            // 이미지 URL
            const imageUrl = node.getAttribute('href');

            // 컨텐츠 셋팅
            dialogContent = document.createElement('img');
            dialogContent.src = imageUrl;
            dialogContent.style.display = 'none';

        } else if( _this.options.type == 'iframe' ) {

            // Iframe URL
            let iframeUrl = node.getAttribute('href');

            Object.entries(_this.options.iframe.patterns).forEach( ( [key, pattern] ) => {
                if( iframeUrl.indexOf( pattern.index ) > -1 ) {
					if( pattern.id ) {
						if( typeof pattern.id === 'string' ) {
							iframeUrl = iframeUrl.substr(iframeUrl.lastIndexOf(pattern.id)+pattern.id.length, iframeUrl.length);
						} else {
							iframeUrl = pattern.id.call( pattern, iframeUrl );
						}
					}
					iframeUrl = pattern.src.replace( '%id%', iframeUrl );
					return false;
				}
            });

            // 컨텐츠 셋팅
            const iframe = document.createElement('iframe');

            iframe.src = iframeUrl;
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowFullScreen', '');

            dialogContent = document.createElement('div');
            dialogContent.classList.add(`${_this.options.prefix}__iframe-scaler`);
            dialogContent.appendChild(iframe);
            
        }

        // Render
        if( _this.options.closeButton ) _this.dialog.querySelector(`.${_this.options.prefix}__content`).appendChild( closeButton );
        _this.dialog.querySelector(`.${_this.options.prefix}__content`).appendChild( dialogContent );
        document.body.appendChild( _this.dialog );

        // Scroll 위치 저장
        const scrollStorage = window.scrollY;
        document.body.setAttribute(`${_this.options.prefix}-scrolltop`, scrollStorage);

        // Open 클래스 추가
        document.body.classList.add(`open-${_this.options.prefix}`);
        
        // 배경 고정위치 Helper
        if( document.querySelector('html').classList.contains('mobile') ) {
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollStorage}px`;
        }        

        // Open
        gsap.fromTo(_this.dialog, {
            autoAlpha: 0
        }, {
            autoAlpha: 1,
            duration: .3,
            ease: 'power2.out',
            onStart: function() {
                _this.dialog.showModal();
            },
            onComplete: function () {
                if( _this.options.type == 'image' ) {

                    imagesLoaded(_this.dialog, function(){
                        gsap.fromTo( _this.dialog.querySelector(`.${_this.options.prefix}__content img`), {
                            autoAlpha: 0
                        }, {
                            autoAlpha: 1,
                            duration: .2,
                            onStart: function() {
                                _this.dialog.querySelector(`.${_this.options.prefix}__loading-spinner`).remove();
                                _this.dialog.querySelector(`.${_this.options.prefix}__content img`).style.removeProperty('display');
                            }
                        });

                        // verticalFit 활성화
                        if( _this.options.image.verticalFit ) {
                            if( _this.options.image.verticalFitEventListener ) {
                                _this.options.image.verticalFitEventListener = false;
                                window.addEventListener('resize', _this.resizeImage.bind(_this), false);
                            }
                            _this.resizeImage();
                        }
                    });

                } else if( _this.options.type == 'iframe' ) {

                    _this.dialog.querySelector(`.${_this.options.prefix}__loading-spinner`).remove();

                }

                _this.options.callbacks.open(); // callback
            }
        });

    }



    /**
     * Popup 닫기
     */
    closePopup( event ) {

        event.preventDefault();
        event.stopPropagation();

        const _this = this;
        
        if( !!_this.dialog && ( !!!event.target.closest(`.${_this.options.prefix}__content`) || !!event.target.closest(`.${_this.options.prefix}__close`) || _this.options.closeOnContentClick ) ) {
            gsap.to(_this.dialog, {
                autoAlpha: 0,
                duration: .3,
                ease: 'power2.out',
                onStart: function () {
                    _this.options.callbacks.beforeClose(); // callback

                    // 배경 고정위치 Helper
                    if ( document.querySelector('html').classList.contains('mobile') ) {
                        document.body.style.removeProperty('position');
                        document.body.style.removeProperty('top');
                    }
                    window.scrollTo(0, document.body.getAttribute(`${_this.options.prefix}-scrolltop`));

                    // Open 클래스 제거
                    document.body.classList.remove(`open-${_this.options.prefix}`);
                },
                onComplete: function () {
                    _this.dialog.close();
                    _this.dialog.remove();
                    _this.options.callbacks.close(); // callback
                }
            });
        }

    }



    /**
     * verticalFit 이미지 최대 높이값 지정
     */
    resizeImage() {

        const _this = this;

        _this.dialog.querySelector('img').style.maxHeight = window.innerHeight + 'px';

    }

}
