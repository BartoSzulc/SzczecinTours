
/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');


console.log('test');

window.onload = function() {
    if (window.tinymce) {
        tinymce.PluginManager.add('my_custom_buttons', function(editor, url) {
            // Button for "text-desc text-color6"
            editor.addButton('wrapInDescColor6', {
                text: 'Średni tekst, kolor ciemny',
                icon: false,
                class: 'text-desc text-color6 dark:text-colorContrast',
                onclick: function() {
                    var selectedText = editor.selection.getContent({format: 'html'});
                    if (selectedText.length > 0) {
                        var wrappedText = '<div class="tinymce-text text-desc text-color6 dark:text-colorContrast" data-aos="fade-up">' + selectedText + '</div>';
                        editor.selection.setContent(wrappedText);
                    } else {
                        alert('Najpierw zaznacz tekst');
                    }
                }
            });

            
            // Button for "text-base text-color7"
            editor.addButton('wrapInBaseColor7', {
                text: 'Mały tekst, kolor jasny szary',
                icon: false,
                onclick: function() {
                    var selectedText = editor.selection.getContent({format: 'html'});
                    if (selectedText.length > 0) {
                        var wrappedText = '<div class="tinymce-text text-base text-color7 dark:text-colorContrast" data-aos="fade-up">' + selectedText + '</div>';
                        editor.selection.setContent(wrappedText);
                    } else {
                        alert('Najpierw zaznacz tekst');
                    }
                }
            });
        });
    }
};

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);