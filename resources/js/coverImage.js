$('.cover-image input[type="file"]').on('change', (e) => {
    const image = e.target.files[0];
    const fr = new FileReader();
    
    fr.onload = (e) => {
        $('.cover-image img').attr('src', e.target.result);
    };
    
    fr.readAsDataURL(image);
});