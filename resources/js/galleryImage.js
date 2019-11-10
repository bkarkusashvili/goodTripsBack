$('.gallery-image input[type="file"]').on('change', (e) => {
    $('.gallery-image-cont').html('');
    const images = e.target.files;
    
    for (const image of images) {
        const fr = new FileReader();
        fr.onload = (e) => {
            $('.gallery-image-cont').append(`<img src="${e.target.result}" />`);
        };
        fr.readAsDataURL(image);
    }
});
