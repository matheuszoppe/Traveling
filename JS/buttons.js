function minimizar(id, expandir, contrair){
    if(document.getElementById(id).style.display == 'block'){
        document.getElementById(id).style.display = 'none';
        document.getElementById(contrair).style.display = 'none';
        document.getElementById(expandir).style.display = 'block';

    }else{
        document.getElementById(id).style.display = 'block';
        document.getElementById(contrair).style.display = 'block';
        document.getElementById(expandir).style.display = 'none';
    }
}

const Fundo ={
    open(){
        document
        .querySelector('.fundo')
        .classList
        .add('active')
    },
    close(){
        document
        .querySelector('.fundo')
        .classList
        .remove('active')

    }
}