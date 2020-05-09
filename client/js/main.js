let id = null;

async function createUser(){
    let name = document.getElementById('name').value ,
        email = document.getElementById('email').value; 
    let formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);    
    const res = await fetch('http://localhost/slim/src/public/index.php/users', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    await getUsers();
}

async function getUsers(){
    let res = await fetch("http://localhost/slim/src/public/index.php/users");
    let users = await res.json();

    document.querySelector('#users').innerHTML = '';

    users.forEach((user) => {
        document.querySelector('#users').innerHTML += `
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${user.name}</h5>
                                <p class="card-text">${user.email}</p>
                                <button class="btn btn-warning btn-sm" id="update" title="update" type="button" onclick="inputData('${user.id}', '${user.name}', '${user.email}')" data-toggle="modal" data-target="#mx"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                <button class="btn btn-danger btn-sm" title="delete" onclick="deleteUser(${user.id})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button class="btn btn-primary btn-sm" onclick="getUser(${user.id})">About</button> 
                            </div>
                        </div>
                    </div>
                    
        `
    });
}

async function getUser(id){
    let res = await fetch(`http://localhost/slim/src/public/index.php/users/${id}`);
    let user = await res.json();

    document.querySelector('#users').innerHTML = '';
        
    document.querySelector('#users').innerHTML += `
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${user.name}</h5>
                                <p class="card-text">${user.email}</p>
                                <button class="btn btn-warning btn-sm" id="update" title="update" type="button" onclick="inputData('${user.id}', '${user.name}', '${user.email}')" data-toggle="modal" data-target="#mx"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                <button class="btn btn-danger btn-sm" title="delete" onclick="deleteUser(${user.id})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <button class="btn btn-primary btn-sm" onclick="getUsers()">ShowAllUsers</button>   
                            </div>
                        </div>
                    </div>
                    
        `
}

function inputData(idd, name, email){
    id = idd;
    document.getElementById('namee').value = name;
    document.getElementById('emaill').value = email;

}

async function updateUser(){
    let name = document.getElementById('namee').value ,
        email = document.getElementById('emaill').value;  
    const datat = {
        name: name,
        email: email
    }
    const res = await fetch(`http://localhost/slim/src/public/index.php/users/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(datat)
    });
    const data = await res.json();
    console.log(data);
    await getUsers();
}

async function deleteUser(id){  
    const res = await fetch(`http://localhost/slim/src/public/index.php/users/${id}`, {
        method: 'DELETE',
    });
    const data = await res.json();
    console.log(data);
    await getUsers();
}



getUsers();