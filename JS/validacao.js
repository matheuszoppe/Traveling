
const teste = {
    
    date(){
        var stgida = document.formu.ida.value;
        var dataIda = new Date(stgida.split('/').reverse().join('/'));
        var stgvolta = document.formu.volta.value;
        var dataVolta = new Date(stgvolta.split('/').reverse().join('/'));
        var dataAtual = new Date();
        if(stgida == ""){
            alert("Data de ida vazia!")
            return false
        }else if(stgvolta == ""){
            alert("Data de volta vazia!")
            return false
        }
       
        if(dataIda < dataAtual){
            alert("Data menor que a atual")
            return false
        }else if(dataIda > dataVolta){
            alert("Data de volta menor que a de ida!")
            return false
        }
        return true
    },
    
    form(){
        var validar=true;
        if(document.formu.end.value == ""){
            document.getElementById("end").style.outline ='2px solid red'
            document.formu.end.focus();
            alert("Ops! Parece que alguns campos não foram preenchidos");
            return false
            
        }else document.getElementById("end").style.outline ='0'

        if(document.formu.city.value == ""){
            document.getElementById("city").style.outline ='2px solid red'
            document.formu.city.focus();
            alert("Ops! Parece que alguns campos não foram preenchidos");
            return false
            
        }else document.getElementById("city").style.outline ='0'

        if(document.formu.cep.value == ""){
            document.getElementById("cep").style.outline ='2px solid red'
            document.formu.cep.focus();
            alert("Ops! Parece que alguns campos não foram preenchidos");
            return false
            
        }else document.getElementById("cep").style.outline ='0'
        if(document.formu.fone.value == ""){
            document.getElementById("fone").style.outline ='2px solid red'
            document.formu.fone.focus();
            alert("Ops! Parece que alguns campos não foram preenchidos");
            return false
            
        }else document.getElementById("fone").style.outline ='0'
        if(document.formu.email.value == ""){
            document.getElementById("email").style.outline ='2px solid red'
            document.formu.email.focus();
            alert("Ops! Parece que alguns campos não foram preenchidos");
            return false
            
        }else document.getElementById("email").style.outline ='0'
        return true      
        
    }
    
}