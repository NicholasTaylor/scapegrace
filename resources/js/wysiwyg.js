ClassicEditor
    .create( document.querySelector('#body'))
    .then( body => {
        console.log(body);
    })
    .catch( error=> {
        console.error(error);
    })