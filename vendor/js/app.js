//generate new people in the db
function generate (){ console.log("generar...")
    const url = "http://localhost/mvcNombres/person/generate"
    console.log(item)
    const requestOptions = {
        method: "POST",
        header :{
            "Content-Type" : "application/json",
        }
    }
    fetch(url, requestOptions)
    .then(response => response.json())
    .then(data => {  console.log("data",data)
        alert(data.message)
        load()
    })
    .catch(error=> console.log("error",error))
}

//load people function
function load(){
    code =""
    fetch("http://localhost/mvcNombres/person/get")
    .then(response=> response.json())
    .then(data =>{ console.log(data)
        data.forEach((item) =>{
            code +='<tr>'
            code += '<td>'+item.id+'</td>'
            code += '    <td>'+item.name+'</td>'
            code += '    <td>'+item.lastname+'</td>'
            code += '    <td>'+item.age+'</td>'
            code += '    <td><a href="#" onclick="edit('+item.id+',\'' + item.name + '\',\'' + item.lastname + '\',\'' + item.age + '\')">Editar</a></td>'
            code += '    <td><a href="#" onclick="delete1('+item.id+')">Eliminar</a></td>'
            code +='</tr>'  
       }) 
        const tabla = document.getElementById("table_persons")
        tabla.innerHTML = code
    })
}
function edit(id,name,lastname, age){ console.log("edit")
    openModal()
    document.frm.txt_id.value = id
    document.frm.txt_name.value = name
    document.frm.txt_lastname.value = lastname
    document.frm.txt_age.value = age
}

function update (){ console.log("actualizar...")
    const url = "http://localhost/mvcNombres/person/put"
    const item = {
        id: document.frm.txt_id.value,
        name : document.frm.txt_name.value,
        lastname : document.frm.txt_lastname.value,
        age : document.frm.txt_age.value
    }
    console.log(item)
    const requestOptions = {
        method: "POST",
        header :{
            "Content-Type" : "application/json",
        }
        ,body : JSON.stringify(item)
    }
    fetch(url, requestOptions)
    .then(response => response.json())
    .then(data => {  console.log("data",data)
        alert(data.message)
        closeModal() 
    })
    .catch(error=> console.log("error",error))
}

function openModal() {
    document.getElementById("backdrop").style.display = "block"
    document.getElementById("exampleModal").style.display = "block"
    document.getElementById("exampleModal").classList.add("show")
}
function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("exampleModal").style.display = "none"
    document.getElementById("exampleModal").classList.remove("show")
}
// Get the modal
var modal = document.getElementById('exampleModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal()
    }
}

function delete1(id){ console.log("eliminar")
    if(confirm("Deseas eliminar esta persona?")){
        const url = "http://localhost/mvcNombres/person/delete"
        const item = {
            id: id
        }
        console.log(item)
        const requestOptions = {
            method: "POST",
            header :{
                "Content-Type" : "application/json",
            }
            ,body : JSON.stringify(item)
            
        }
        fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {  console.log("data",data)
            alert(data.message)
            closeModal() 
        })
        .catch(error=> console.log("error",error))
    }
}