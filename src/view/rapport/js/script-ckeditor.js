/*
import ClassicEditor from '../../../node_modules/@ckeditor/ckeditor5-editor-classic/src/classiceditor';
*/
ClassicEditor
    .create( document.querySelector( '#overview' ), {
        //removePlugins: [ 'Heading' ],
        //toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
    })
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );