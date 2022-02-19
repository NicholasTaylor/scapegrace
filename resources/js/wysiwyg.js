const bodyField = document.querySelector('#body');

ClassicEditor
    .create( bodyField )
    .then( body => {
        body.setData(bodyField.getAttribute('value'))
    })
    .catch( error=> {
        console.error(error);
    })