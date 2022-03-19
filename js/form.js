let form = document.querySelector('#regForm');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    let name = document.getElementsByName('rName').value;
    let email = document.getElementsByName('rEmail').value;
    let password = document.getElementsByName('rPassword').value;
    let flag = true

    if(!name || name == '') {
        let span = document.getElementById('name');
        span.classList.add('alert')
        span.classList.add('alert-danger')
        span.innerText = "Name Cannot Be empty."
        flag = false
    } else if(name && name.length <= 5) {
        let span = document.getElementById('name');
        span.classList.add('alert')
        span.classList.add('alert-danger')
        span.innerText = "Name Should Be greater than 5 charachers."
        flag = false
    }

    if(flag) {
        form.submit();
    }
});