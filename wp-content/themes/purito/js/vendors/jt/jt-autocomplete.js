/**
 * Email 자동완성 플러그인
 *
 * @version 1.0.0
 * @since 2023-03-20
 * @author STUDIO-JT (KMS)
 * @example
 * new JtAutocomplete( input, {
 *     prefix     : 'jt-automail',
 *     inputClass : 'jt-automail__input',
 *     listClass  : 'jt-automail__list',
 *     focusClass : 'jt-automail--focus',
 *     openClass  : 'jt-automail--open',
 *     domain     : ['studio-jt.co.kr', '...'],
 *     maxLength  : 3
 * });
 */
class JtAutocomplete {

    /**
     * JtAutocomplete 생성
     *
     * @constructor
     * @param {HTMLElement} element - Mail Input Element
     * @param {Object} [args] - 옵션
     * @param {string} [args.prefix='jt-automail'] - 커스텀 이메일 UI에 추가되는 class를 설정합니다.
     * @param {string} [args.inputClass='jt-automail__input'] - Input 요소에 추가되는 class를 설정합니다.
     * @param {string} [args.listClass='jt-automail__list'] - 자동완성 리스트에 추가되는 class를 설정합니다.
     * @param {string} [args.focusClass='jt-automail--focus'] - 자동완성 리스트 아이템 요소가 포커스 되었을때 추가되는 class를 설정합니다.
     * @param {string} [args.openClass='jt-automail--open'] - 자동완성 리스트가 활성화 되었을때 추가되는 class를 설정합니다.
     * @param {Array.<string>} [args.domain[]=['naver.com', 'hanmail.net', 'nate.com', 'gmail.com', 'daum.net', 'hotmail.com', 'yahoo.co.kr', 'paran.com', 'lycos.co.kr', 'hanmail.com', 'korea.com', 'empal.com', 'dreamwiz.com', 'yahoo.com', 'korea.kr']] - 자동완성 도메인 리스트를 설정합니다.
     * @param {number} [args.maxLength=5] - 자동완성 아이템 최대 노출수를 설정합니다.
     */
    constructor( element, args ) {

        if( typeof element == 'undefined' ) return; // Required

        const _this = this;

        _this.input    = element; // Input 필드
        _this.focusIdx = -1;      // 포커스 위치를 저장할 변수

        _this.options  = {
            prefix     : 'jt-automail',
            inputClass : 'jt-automail__input',
            listClass  : 'jt-automail__list',
            focusClass : 'jt-automail--focus',
            openClass  : 'jt-automail--open',
            domain     : ['naver.com', 'hanmail.net', 'nate.com', 'gmail.com', 'daum.net', 'hotmail.com', 'yahoo.co.kr', 'paran.com', 'lycos.co.kr', 'hanmail.com', 'korea.com', 'empal.com', 'dreamwiz.com', 'yahoo.com', 'korea.kr'],
            maxLength  : 5
        };

        // 파라미터 확인
        if( typeof args != 'undefined' ) {
            for( const [key, value] of Object.entries(args) ) {
                _this.options[key] = value;
            }
        }

        // Input 셋팅
        _this.input.setAttribute('autocomplete', 'off');
        _this.input.setAttribute('autocapitalize', 'off');
        _this.input.classList.add(_this.options.inputClass);

        // 컨테이너 생성
        _this.container = document.createElement('div');
        _this.container.setAttribute('class', _this.options.prefix);
        _this.input.parentElement.insertBefore(_this.container, _this.input);
        _this.container.appendChild(_this.input);

        // 리스너 할당
        _this.input.addEventListener('input', _this.onInput.bind(_this), false);
        _this.input.addEventListener('keydown', _this.onKeydown.bind(_this), false);

        document.addEventListener('click', _this.removeList.bind(_this), false);

    }



    /**
     * Input 이벤트
     */
    onInput() {

        const _this = this;

        // 오래된 데이터 삭제
        _this.removeList();

        // Input 데이터 확인
        const inputData = _this.input.value;

        // 유효성 검사
        if( !inputData || ( inputData.split('@').length - 1 > 1 ) ) { return false; }

        // 포커스 위치 초기화
        _this.focusIdx = -1;

        // Input 데이터 가공
        const id          = inputData.split('@')[0];
        const email       = inputData.toLowerCase().split('@');
        const resultLabel = id + ( ( email[1] !== undefined ) ? '@' + email[1] : '' );

        // 자동완성 검사
        let suggest = [];

        for( let i = 0 ; i < _this.options.domain.length ; i++ ) {

            if( email.length != 2 ){

                if( suggest.length >= _this.options.maxLength ){ break; }

                const resultValue = id + '@' + _this.options.domain[i];
                const resultComplete = resultValue.substring(inputData.length);
                const resultData = {
                    value        : resultValue,
                    label        : resultLabel,
                    autocomplete : resultComplete
                };
                suggest.push(resultData);

            } else {

                if( _this.options.domain[i].indexOf(email[1]) === 0 ) {

                    if( _this.options.domain[i] === email[1] ) { return false; }
                    if( suggest.length >= _this.options.maxLength ) { break; }

                    const resultValue = id + '@' + _this.options.domain[i];
                    const resultComplete = resultValue.substring(inputData.length);
                    const resultData = {
                        value        : resultValue,
                        label        : resultLabel,
                        autocomplete : resultComplete
                    };
                    suggest.push(resultData);

                }

            }
            
        }

        if( suggest.length > 0 ) _this.addList(suggest);

    }



    /**
     * Keydown 이벤트 (자동완성 아이템 포커스)
     */
    onKeydown( event ) {

        const _this = this;

        let list = document.getElementById(_this.options.prefix + '-' + _this.input.id);
        if( list ) { list = list.getElementsByTagName('li'); }

        switch ( event.keyCode ) {
            case 38: // Up
                _this.focusIdx--;
                _this.addFocus(list);
                break;
            case 40: // Down
                _this.focusIdx++;
                _this.addFocus(list);
                break;
            case 13: // Enter
                event.preventDefault();
                if( _this.focusIdx > -1 && list ) list[_this.focusIdx].click();
                break;
            default:
                break;
        }

    }



    /**
     * 자동완성 데이터 생성
     * @param {Array.<Object>} suggest - 자동완성 데이터
     */
    addList( suggest ) {

        const _this = this;

        let list = document.createElement('ul');
            list.setAttribute('id', _this.options.prefix + '-' + _this.input.id);
            list.setAttribute('class', _this.options.listClass);
        
        _this.container.appendChild( list );

        for( let i = 0 ; i < suggest.length ; i++ ) {
            let item = document.createElement('li');
                item.setAttribute('data-value', suggest[i].value);
                item.innerHTML = '<span>' + suggest[i].label + '</span>' + suggest[i].autocomplete;
                item.addEventListener('click', function(){
                    _this.input.value = this.getAttribute('data-value');
                    _this.removeList();
                });

            list.appendChild(item);
        }

        // Add ui open class
        _this.input.closest('.' + _this.options.prefix).classList.add(_this.options.openClass);

    }



    /**
     * 자동완성 데이터 삭제
     */
    removeList() {
        
        const _this = this;
        const oldList = document.getElementsByClassName(_this.options.listClass);

        for( let i = 0 ; i < oldList.length ; i++ ) {
            oldList[i].parentNode.removeChild(oldList[i]);
        }

        // Remove ui open class
        _this.input.closest('.' + _this.options.prefix).classList.remove(_this.options.openClass);

    }



    /**
     * 자동완성 아이템 포커스 추가
     * @param {HTMLElement} list - 자동완성 리스트
     */
    addFocus( list ) {

        const _this = this;

        if( !list ) return false;

        _this.removeFocus(list);
        if( _this.focusIdx >= list.length ) _this.focusIdx = 0;
        if( _this.focusIdx < 0 ) _this.focusIdx = (list.length - 1);
        list[_this.focusIdx].classList.add(_this.options.focusClass);

    }



    /**
     * 자동완성 아이템 포커스 삭제
     * @param {HTMLElement} list - 자동완성 리스트
     */
    removeFocus( list ) {

        const _this = this;

        for( let i = 0 ; i < list.length ; i++ ) {
            list[i].classList.remove(_this.options.focusClass);
        }

    }

}
