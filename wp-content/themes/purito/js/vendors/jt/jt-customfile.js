/**
 * 첨부파일 커스텀 플러그인
 *
 * @version 1.0.0
 * @since 2023-03-22
 * @author STUDIO-JT (KMS)
 *
 * @example
 * new JtCustomFile( input, {
       prefix         : 'jt-customfile',
       inputClass     : 'jt-customfile__input',
       buttonClass    : 'jt-customfile__button',
       buttonLabel    : '파일 업로드',
       buttonBuilder  : '',
       listClass      : 'jt-customfile__list',
       itemClass      : 'jt-customfile__item',
       deleteClass    : 'jt-customfile__delete',
       deleteBuilder  : '',
       fileExtensions : 'jpg;jpeg;png;gif',
       fileMaxLength  : 5,
       fileMaxSize    : 10485760
 * });
 */
class JtCustomFile {

    /**
     * JtCustomFile 생성
     *
     * @constructor
     * @param {HTMLElement} element - Input File Element
     * @param {Object} [args] - 옵션
     * @param {string} [args.prefix='jt-customfile'] - 커스텀 파일 UI에 추가되는 class를 설정합니다.
     * @param {string} [args.inputClass='jt-customfile__input'] - Input 요소에 추가되는 class를 설정합니다.
     * @param {string} [args.buttonClass='jt-customfile__button'] - 파일 업로드 버튼에 추가되는 class를 설정합니다.
     * @param {string} [args.buttonLabel='파일 업로드'] - 파일 업로드 버튼 라벨을 설정합니다.
     * @param {string} [args.buttonBuilder=''] - 파일 업로드 버튼 라벨 뒤에 추가될 커스텀 마크업을 설정합니다.
     * @param {string} [args.listClass='jt-customfile__list'] - 파일 목록에 추가되는 class를 설정합니다.
     * @param {string} [args.itemClass='jt-customfile__button'] - 파일 아이템 요소에 추가되는 class를 설정합니다.
     * @param {string} [args.deleteClass='jt-customfile__delete'] - 파일 삭제버튼에 추가되는 class를 설정합니다.
     * @param {string} [args.deleteBuilder='<i class="jt-icon"><svg width="12px" height="12px" x="0px" y="0px" viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve"><path fill="black" d="M7.4,6l2.8,2.8l-1.4,1.4L6,7.4l-2.8,2.8L1.8,8.8L4.6,6L1.8,3.2l1.4-1.4L6,4.6l2.8-2.8l1.4,1.4L7.4,6z"/></svg></i>'] - 파일 삭제버튼 마크업을 지정합니다.
     * @param {string} [args.fileExtensions='tiff;tif;jpg;jpeg;png;gif;bmp;webp;avif;heif;heic'] - 업로드 허용 확장자를 설정합니다.
     * @param {number} [args.fileMaxLength=10] - 등록가능 갯수를 설정합니다.
     * @param {number} [args.fileMaxSize=2097152] - 등록가능 파일 크기를 설정합니다. (단위 : 바이트 , 0 = 제한 없음)
     */
    constructor( element, args ) {

        if( typeof element == 'undefined' ) return; // Required

        const _this = this;

        _this.input   = element; // Input 필드
        _this.fileData = new DataTransfer(); // FileList

        _this.options = {
            prefix         : 'jt-customfile',
            inputClass     : 'jt-customfile__input',
            buttonClass    : 'jt-customfile__button',
            buttonLabel    : '파일 업로드',
            buttonBuilder  : '', 
            listClass      : 'jt-customfile__list',
            itemClass      : 'jt-customfile__item',
            deleteClass    : 'jt-customfile__delete',
            deleteBuilder  : '<i class="jt-icon"><svg width="12px" height="12px" x="0px" y="0px" viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve"><path fill="black" d="M7.4,6l2.8,2.8l-1.4,1.4L6,7.4l-2.8,2.8L1.8,8.8L4.6,6L1.8,3.2l1.4-1.4L6,4.6l2.8-2.8l1.4,1.4L7.4,6z"/></svg></i>',
			fileExtensions : 'tiff;tif;jpg;jpeg;png;gif;bmp;webp;avif;heif;heic',
			fileMaxLength  : 10,
			fileMaxSize    : 2097152 // 10485760 (10MB)
        };

        // 파라미터 확인
        if( typeof args != 'undefined' ) {
            for( const [key, value] of Object.entries(args) ) {
                _this.options[key] = value;
            }
        }

        // Input 셋팅
        _this.input.classList.add(_this.options.inputClass);

        // Outer 컨테이너 생성
        _this.container = document.createElement('div');
        _this.container.setAttribute('class', _this.options.prefix);
        _this.input.parentElement.insertBefore(_this.container, _this.input);
        _this.container.appendChild(_this.input);

        // Inner 컨테이너 생성
        _this.inner = document.createElement('div');
        _this.inner.setAttribute('class', _this.options.prefix + '__field');
        _this.input.parentElement.insertBefore(_this.inner, _this.input);
        _this.inner.appendChild(_this.input);

        // 버튼 생성
        _this.button = document.createElement('button');
        _this.button.setAttribute('type', 'button');
        _this.button.setAttribute('tabIndex', -1);
        _this.button.setAttribute('class', _this.options.buttonClass);
        _this.button.innerHTML = '<span>' + _this.options.buttonLabel + '</span>' + _this.options.buttonBuilder;
        _this.inner.appendChild(_this.button);

        // 리스트 컨테이너 생성
        _this.list = document.createElement('div');
        _this.list.setAttribute('class', _this.options.listClass);
        _this.container.appendChild(_this.list);

        // 리스너 할당
        _this.input.addEventListener('click', _this.onClick.bind(_this), false);
        _this.input.addEventListener('change', _this.onChange.bind(_this), false);

    }



    /**
     * Click 이벤트
     */
    onClick( event ) {

        var _this = this;

        if( !_this.isCount( _this.getCount() ) ) event.preventDefault();

    }



    /**
     * Change 이벤트
     */
    onChange() {

        const _this = this;

        // 신규 파일 데이터
        const newFilesList = _this.input.files;
        const newFilesCount = newFilesList.length;

        // 유효성 체크
        if( !_this.isCount( _this.getCount() + newFilesCount ) ) return false;

        for( let i = 0 ; i < newFilesCount ; i++ ){
            if( !_this.isExts(newFilesList[i].name) ) return false;
            if( !_this.isSize(newFilesList[i].size) ) return false;
        }

        // 파일 추가
        for( let i = 0 ; i < newFilesCount ; i++ ) {
            _this.addFile(newFilesList[i]);
        }

        // Input 데이터 동기화
        _this.setData();

    }



    /**
     * 리스트에 추가된 파일항목 추가
     * @param {} file
	 */
    addFile( file ) {

        const _this = this;

        const fileName = file.name.substring(0, file.name.lastIndexOf('.'));
        const fileExt = _this.getExts(file.name);

        // 첨부파일 UI 생성
        let item = document.createElement('div');
            item.setAttribute('class', _this.options.itemClass);
            item.innerHTML = `<span>${( fileName.length > 12) ? fileName.substring(0,12) + '...' : fileName}.${fileExt}</span>
                              <button type="button" class="${_this.options.deleteClass}">
                                  <span class="sr-only">파일삭제</span>
                                  ${_this.options.deleteBuilder}
                              </button>`;
            item.querySelector('button').addEventListener('click', function(e){
                _this.removeFile(e);
            });

        _this.list.appendChild(item);

        // FileList 추가
        _this.fileData.items.add(file);

    }



    /**
     * 파일삭제
	 */
    removeFile( event ){

        var _this = this;

        const items   = event.target.closest('.' + _this.options.listClass).children;
        const current = event.target.closest('.' + _this.options.itemClass);
        const index   = [].indexOf.call(items, current);

        // UI 삭제
        current.remove();

        // FileList 삭제
        _this.fileData.items.remove(index);

        // Input 데이터 동기화
        _this.setData();

    }



    /**
     * Input 데이터 동기화
     */
    setData() {
        
        var _this = this;

        _this.input.files = _this.fileData.files;

    }



    /**
     * 첨부파일 갯수 반환
     * @return {number}
     */
    getCount() {
        
        var _this = this;

        return _this.fileData.items.length;

    }



    /**
     * 첨부파일 확장자 반환
     * @param {string} name
     * @return {string}
     */
    getExts( name ) {

        return name.substr( 2 + ( ~-name.lastIndexOf('.') >>> 0 ) ).toLowerCase();

    }



    /**
     * 최대 등록갯수 체크
     * @param {number} total
     * @return {boolean}
     */
    isCount( total ) {

        var _this = this;

        if( total > _this.options.fileMaxLength ) {

            _this.callAlert( '최대 ' + _this.options.fileMaxLength + '개까지 첨부가능합니다.' );
            _this.setData();

            return false;

        }

        return true;

    }



    /**
     * 확장자 유효성 체크
     * @param {string} val
     * @return {boolean}
     */
    isExts( val ) {

        const _this = this;
        
        const fileExt = _this.getExts(val);

        if( _this.options.fileExtensions.toLowerCase().indexOf(fileExt) < 0 ){

            _this.callAlert( '지원하지 않는 확장자입니다.' );
            _this.setData();

            return false;

        }

        return true;

    }



    /**
     * File 크기 체크
     * @param {number} size
     * @return {boolean}
     */
    isSize( size ) {

        const _this = this;

        if( _this.options.fileMaxSize > 0 && _this.options.fileMaxSize < size ) {

            _this.callAlert( '최대 ' + (_this.options.fileMaxSize / 1024 / 1024) + 'M까지 첨부가능합니다.' );
            _this.setData();

            return false;
            
        }

        return true;

    }



    /**
     * 안내 메세지 호출
     * @param {string} msg
     */
    callAlert( msg ) {

        if( typeof JT === 'undefined' ) {

            alert( msg );

        } else {

            JT.confirm( msg );
        
        }

    }

}