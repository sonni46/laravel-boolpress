require('./bootstrap');

// usando la query prendiamo tutte le classi in html con i nome delete-post
const deleteForm = document.querySelectorAll('.deleteForm');
deleteForm.forEach(item => {
    item.addEventListener('submit', function(e){
        const resp = confirm('Vuoi cancellare?');
        if(!resp){
            e.preventDefault();
        }
    })
})
