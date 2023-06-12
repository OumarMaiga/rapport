tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount pagebreak',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | pagebreak',
        //content_style: "body { margin: 1rem auto; max-width: 900px; }",
        images_upload_url: 'postAcceptor.php',
        automatic_uploads: false,
});