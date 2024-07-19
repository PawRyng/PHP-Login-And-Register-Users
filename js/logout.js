$('[data-type="logout-user"]').on('click', (e)=>{
e.preventDefault();
$.get('/php/logout.php')
.done((data, textStatus, xhr) => {
    const statusCode = xhr.status
    if(statusCode === 200) window.location = '/'
})
.fail(()=> {
    console.error('Error');
});
})