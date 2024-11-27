import './bootstrap';
import 'bootstrap';
import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from 'ckeditor5';
import { FormatPainter } from 'ckeditor5-premium-features';

// import 'ckeditor5/ckeditor5.css';
//
// ClassicEditor
//     .create( document.querySelector( '#editor' ), {
//         plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
//         toolbar: [
//             'undo', 'redo', '|', 'bold', 'italic', '|',
//             'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
//         ]
//     } )
//     .then( /* ... */ )
//     .catch( /* ... */ );

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
