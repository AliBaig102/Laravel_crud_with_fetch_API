<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<h1 id="h1">All Users</h1>
<a href="#" class="add_new">Add New</a>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
    <tr>
        <td>{{$value->student_id}}</td>
        <td>{{$value->student_name}}</td>
        <td>{{$value->student_email}}</td>
        <td>{{$value->student_age}}</td>
        <td><a href="#" onclick="update(this,{{$value->student_id}})">Update</a></td>
        <td><a href="#" onclick="deleteData(this,{{$value->student_id}})">Delete</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
<div class="model add_model">
    <form action="/insert" method="post">
        <h1>Insert Form</h1>
        @csrf
        <div>
            <label for="name">Name</label> :
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="email">Email</label> :
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="age">Age</label> :
            <input type="text" name="age" id="age">
        </div>
        <button type="submit" name="inserted"> Insert</button>
    </form>
</div>
<div class="model edit_model">
    <form method="post">
        @csrf
        <h1>Update Form</h1>
        <div>
            <label for="name">Name</label> :
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="email">Email</label> :
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="age">Age</label> :
            <input type="text" name="age" id="age">
        </div>
        <button type="submit" name="updated"> Update</button>
    </form>
</div>
<div class="model delete_model">
    <form method="post" action="/delete">
        @csrf
        <strong>Do You Really Want To Delete This Record ??</strong>
        <input type="hidden" name="id" id="id">
        <div class="btn_container">
        <button type="submit" name="delete"> Delete</button>
        <button type="reset" id="cancel_btn"> Cancel</button>
        </div>
    </form>
</div>
</body>
</html>
<script>
    const add_new_btn=document.querySelector('.add_new');
    const models=document.querySelectorAll('.model');
    models.forEach((model,i)=>{
        model.addEventListener('click',(e)=>{
            if (e.currentTarget===e.target){
                model.classList.remove('active');
            }
        })
    });
    add_new_btn.addEventListener('click',(e)=>{
        let add_model=document.querySelector('.add_model');
        add_model.classList.add('active');
    });
    function update(el,id){
        let update_model=document.querySelector('.edit_model')
        let csrf_token=document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let name=update_model.querySelector('#name');
        let email=update_model.querySelector('#email');
        let age=update_model.querySelector('#age');
        let update_form=update_model.querySelector('form');
        update_form.setAttribute('action',`/update/${id}`);
        fetch('/singleUser',{
            method:"POST",
            body:JSON.stringify({'id':id}),
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN':csrf_token,
            }
        })
            .then(response=>response.json())
            .then((data)=>{
                name.value=data[0].student_name;
                email.value=data[0].student_email;
                age.value=data[0].student_age;
            })
            .catch(error=>console.log(error));
        update_model.classList.add('active');
    }
    function deleteData(el,id){
        let delete_model=document.querySelector('.delete_model');
        delete_model.classList.add('active');
        let id_input=delete_model.querySelector('#id');
        id_input.value = id;
    }
        let cancel_btn=document.querySelector('#cancel_btn')
    cancel_btn.addEventListener('click',(e)=>{
       e.preventDefault();
       e.target.parentElement.parentElement.parentElement.classList.remove('active')
    });

</script>
