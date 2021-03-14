let infos = document.querySelectorAll('.infos');
let details = document.querySelectorAll('.details');
let dtName = document.querySelectorAll('.dt-name');
let dtId = document.querySelectorAll('.dt-id');
let dtPhone = document.querySelectorAll('.dt-phone');
let dtJob = document.querySelectorAll('.dt-job');
let dtEmail = document.querySelectorAll('.dt-email');



details.forEach((element, index) => {

    element.addEventListener('click', (e) => {
        let id = e.target.dataset.id;
        
        let aName = infos[index].dataset.name;
        let eamil = infos[index].dataset.email;
        let phone = infos[index].dataset.phone;
        let job = infos[index].dataset.job;

        dtId[0].innerHTML = id;
        dtJob[0].innerHTML = job;
        dtPhone[0].innerHTML = phone;
        dtEmail[0].innerHTML = eamil;
        dtName[0].innerHTML = aName;
    })
})
let edit = document.querySelectorAll('.edit');

edit.forEach((element,index) => {
    element.addEventListener('click', (e) => {
        let id = e.target.dataset.id;
        
        dtName[1].value = infos[index].dataset.name;
        dtJob[1].value = infos[index].dataset.job;
        dtPhone[1].value = infos[index].dataset.phone;
        dtEmail[1].value = infos[index].dataset.email;

        let update = document.querySelector('.edit-btn');
        update.addEventListener('click', (e) => {
            e.preventDefault();
            let data = `id=${id}&name=${dtName[1].value}&job=${dtJob[1].value}&phone=${dtPhone[1].value}&email=${dtEmail[1].value}`


            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'update.php', true);
            
            //Send the proper header information along with the request
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.onreadystatechange = function() { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Request finished. Do processing here.
                    let myObj = JSON.parse(this.responseText);
                    
                    if(myObj[0] == 0){
                        
                        myObj.forEach((element, index) => {

                            if (!(element === "")) {
                                
                                switch (index) {
                                    case 1:
                                        dtName[1].value = element;
                                        dtName[1].style.color = 'red'; 
                                        dtName[1].style.border = '1px red solid';

                                        setTimeout(() => {
                                            dtName[1].value = "";
                                            dtName[1].style.border = "1px #ced4da solid";
                                            dtName[1].style.color = "black ";
                                        }, 2000);
                                        break;
                                    case 2:
                                        dtPhone[1].value = element;
                                        dtPhone[1].style.color = 'red'; 
                                        dtPhone[1].style.border = "1px red solid";
                                        setTimeout(() => {
                                            dtPhone[1].value = "";
                                            dtPhone[1].style.border = "1px #ced4da solid";
                                            dtPhone[1].style.color = "black ";
                                        }, 2000);
                                        break;
                                     case 3:
                                         dtJob[1].value = element;
                                         dtJob.style.color = 'red'; 
                                         dtJob.style.border = "1px red solid";
                                         setTimeout(() => {
                                            dtJob[1].value = "";
                                            dtJob[1].style.border = "1px #ced4da solid";
                                            dtJob[1].style.color = "black ";
                                        }, 2000);
                                         break;
                                    case 4:
                                        dtEmail[1].value = element;
                                        dtEmail[1].style.color = 'red'; 
                                        dtEmail[1].style.border = "1px red solid"
                                        setTimeout(() => {
                                            dtEmail[1].value = "";
                                            dtEmail[1].style.border = "1px #ced4da solid";
                                            dtEmail[1].style.color = "black ";
                                        }, 2000);
                                        break;
                                    default:
                                        break;
                                }
                            }
                        });
                  
                    }else{
                        location.reload();
                    }
                    
                }
            }
            
            xhr.send(data);
            
        })
    })
})

let inName = document.querySelectorAll("input[name='name']");
let email = document.querySelectorAll("input[name='email']");
let phone = document.querySelectorAll("input[name='phone']");

const addBtn = document.querySelector('.addBtn');

addBtn.addEventListener('click',(e) => {
    e.preventDefault();
    var isAllOk = true;
    // validate name
    inNameVal = inName[0].value;
    const nameGex = /\W+/;
    if (nameGex.test(inNameVal) || inNameVal === "") {
        isAllOk = false;
        inName[0].value = "invalid name";
        inName[0].style.border = "1px red solid";
        inName[0].style.color = "red ";
        
        setTimeout(() => {
            inName[0].value = "";
            inName[0].style.border = "1px #ced4da solid";
            inName[0].style.color = "black ";
        }, 2000);
    }
    // valider le email
    let emailVal = email[0].value;
    let emailGex = /\w+@\w+\.\w+/;
    
    if (!emailGex.test(emailVal)){
        isAllOk = false;
        email[0].value = "unvalide email adress";
        email[0].style.border = "1px red solid";
        email[0].style.color = "red ";
        
        setTimeout(() => {
            email[0].value = "";
            email[0].style.border = "1px #ced4da solid";
            email[0].style.color = "black ";
        }, 2000);
    }
    // validate phone number
    let phoneVal = phone[0].value;
    let phoneGex = /\D+/;

    if (phoneGex.test(phoneVal) || phoneVal.length >= 15 || phoneVal.length < 10){
        isAllOk = false;
        phone[0].value = "invalide phone number";
        phone[0].style.border = "1px red solid";
        phone[0].style.color = "red ";
        
        setTimeout(() => {
            phone[0].value = "";
            phone[0].style.border = "1px #ced4da solid";
            phone[0].style.color = "black ";
        }, 2000);
    }
    if (isAllOk) {
        phone[0].parentElement.parentElement.submit();
        
    }
    
});
const allDeleteBtns = document.querySelectorAll('.delete');

allDeleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener('click',(e) => {
        let id = deleteBtn.dataset.id;
        let xhr = new XMLHttpRequest();
        xhr.open('post','delete.php',true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = () => {
            if ((this.readyState === 4) && (this.status === 200) ) {
            }
        }
        xhr.send("id="+id);
        location.reload();

        
    });
});

// search
//get all names
let namesArr = [...infos];
namesArr = namesArr.map(element => element.dataset.name)

const searchBtn = document.querySelector('.searchBtn');
const searchInput = document.querySelector('.search-input');

searchBtn.addEventListener('click',(e)=>{
    
    let found = namesArr.find(element => element === searchInput.value)
    if(found === undefined){
        searchInput.style.color = "red"
        searchInput.value = "No record with this name";

       setTimeout(() => {
            searchInput.value = "";
            searchInput.style.color = "black"
        }, 3000);
    }else{
        const result = document.querySelector(`#${found}`);
        result.scrollIntoView();
        result.style.border = "3px gold solid";
        setTimeout(() => {
            result.style.border = "1px #ced4da solid";
        }, 3000);
    }
    
    

})



