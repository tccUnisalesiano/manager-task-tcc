window.onload = function (){
    let btnDropDown = document.querySelector('.btnDropDownForm');
    let divDropDown = document.querySelector('.dropDownForm');
    let setaDropDown = document.querySelector('.setaDropDown');

    btnDropDown.addEventListener('click', () =>{
        if(divDropDown.style.display === 'none'){
            divDropDown.style.display = 'block';
            setaDropDown.style.transform = 'translateY(10%) rotate(140deg)';

        }else{
            divDropDown.style.display = 'none';
            setaDropDown.style.transform = 'translateY(10%) rotate(-45deg)';
        }
    })
};

