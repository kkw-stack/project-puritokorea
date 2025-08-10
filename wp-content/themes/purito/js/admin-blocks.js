window.onload = () => {
    
    /* https://github.com/WordPress/gutenberg/issues/25676#issuecomment-793792766 */

    /* ************************************** *
     * White embed variation block
     * ************************************** */
    const enabledEmbeds = [
        'youtube',
        'vimeo'
    ];
    const embedBlock = wp.blocks.getBlockVariations('core/embed');
    
    if (embedBlock) {
        embedBlock.forEach(function(el) {
            
            // console.log(el.name) // list provider name
            
            if (!enabledEmbeds.includes(el.name)) {
                wp.blocks.unregisterBlockVariation('core/embed', el.name);
            }
        });
    }
    
    // Then hide manual embed button (TODO : find a react way to to this) 
    const head = document.head || document.getElementsByTagName('head')[0],
          style = document.createElement('style');
          
    head.appendChild( style );
    style.appendChild( document.createTextNode('.block-editor-block-types-list[aria-label="임베드"] .block-editor-block-types-list__list-item:first-child {display: none;}') );



    /* ************************************** *
     * White group variation block
     * ************************************** */
    const enabledGroup = [
        'group',
    ];
    const groupBlock = wp.blocks.getBlockVariations('core/group');

    if (groupBlock) {
        groupBlock.forEach(function(el) {
            if (!enabledGroup.includes(el.name)) {
                wp.blocks.unregisterBlockVariation('core/group', el.name);
            }
        });
    }
    


    /* ************************************** *
     * Add block custom style option
     * ************************************** */
    /*
    wp.blocks.registerBlockStyle( 'core/image', {
        name: 'jt-merge',
        label: 'Merge',
    });
    */

}