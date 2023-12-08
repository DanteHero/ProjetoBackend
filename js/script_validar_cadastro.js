//////////// INDEX

/*
   -LOCAL STORAGE: linha 18
   -Regex MASCARAS: linha 33
   -Cep validação: linha 95
   -Mascaras: linha 170
   -Validação dos campos: linha 241
   -darck mode: linha 562
*/
   //------------------------ FERRAMENTA ID------------------------------------------------------------------//////
   function id( el ){
    return document.getElementById( el );
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////     LOCAL STORAGE           /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///---------------salva no local storage -------////

var salvarData = function() {
var login_data = id('login').value;
var senha_data = id('senha').value;

localStorage.setItem('login', login_data);
localStorage.setItem('senha', senha_data);
};
document.onclick = salvarData;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////     Regex MASCARAS                      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
    function mask(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmask()",1)
    }
   
    function execmask(){
    v_obj.value=v_fun(v_obj.value)
    }
   
    function masktel(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d)/,"+$1")
        v=v.replace(/(.{3})(\d)/,"$1 ($2")
        v=v.replace(/(.{7})(\d)/,"$1) $2")
        if(v.length == 12) {
            v=v.replace(/(.{1})$/,"-$1")
        } else if (v.length == 13) {
            v=v.replace(/(.{2})$/,"-$1")
        } else if (v.length == 14) {
            v=v.replace(/(.{3})$/,"-$1")
        } else if (v.length == 15) {
            v=v.replace(/(.{4})$/,"-$1")
        } else if (v.length > 15) {
            v=v.replace(/(.{4})$/,"-$1")
        }
        return v;}  
       
       

    function maskcep(v){
        v=v.replace(/\D/g,"");
        v=v.replace(/(\d{5})(\d)/,"$1-$2");
        return v;
        }

    function maskapenas_letras(v){
            v=v.replace(/\d/g,"");
            return v;
            }

    function maskapenas_numeros(v){
            v=v.replace(/\D/g,"");
            return v;
               }
   
    function maskcpf(v){
        //Remove tudo o que não é dígito
        v=v.replace(/\D/g,"")
        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        //Coloca um ponto entre o terceiro e o quarto dígitosde novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
         return v
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////   CEP validção  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
      id('rua').value=("");
      id('bairro').value=("");
      id('cidade').value=("");
      id('UF').value=("");  
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
      id('rua').value=(conteudo.logradouro);
      id('bairro').value=(conteudo.bairro);
      id('cidade').value=(conteudo.localidade);
      id('UF').value=(conteudo.uf);
      id("span_CEP").style.display='none';
      id("CEP").classList.remove('error_input');
    } //end if.
    else {
        //CEP não Encontrado.
        CEP_valido=false
        id("span_CEP").style.display='block';
        id("CEP").classList.add('error_input');
        id("span_CEP").innerHTML="CEP não encontrado";
        limpa_formulário_cep();  
    }
}
   
function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;
        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
          id('rua').value="...";
          id('bairro').value="...";
          id('cidade').value="...";
          id('UF').value="...";
            //Cria um elemento javascript.
            var script = document.createElement('script');
            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        } //end if.
        else {
            CEP_valido=false
            id("span_CEP").style.display='block';
            id("CEP").classList.add('error_input');
            id("span_CEP").innerHTML="CEP inválido";
            //cep é inválido.
            limpa_formulário_cep();
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
   
     const function_events =()=>{//------------------------ EXECUÇÃO DAS FUNÇÕES COMO EVENTOS------------------------------------------//////
   
     
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////----------------------------------------------------------------------------- MASCARAS ---------------------------------------------///////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     
     
        //TEL FIXO -------
        id('tel_fixo').setAttribute('maxlength', 19);
        id('tel_fixo').onkeypress = function(){
            mask( this, masktel );
        }
       
        //CELULAR -------
        id('tel_cel').setAttribute('maxlength', 19);
        id('tel_cel').onkeypress = function(){
            mask( this, masktel );
        }
       
        //CPF ---------
            id('cpf').setAttribute('maxlength', 14);
            id('cpf').onkeypress = function(){        
            mask( this, maskcpf );}

        //CEP ---------
        id('CEP').setAttribute('maxlength', 9);
        id('CEP').onkeypress = function(){
            mask( this, maskcep );
        }

        //NOME-------------
        id('nome').setAttribute('maxlength', 60);
         
        //NOMEMAT-------------
         id('nomemat').setAttribute('maxlength', 60);

         //COMPLEMENTO-------------
         id('complemento').setAttribute('maxlength', 60);

         //LOGIN-------------
         id('login').setAttribute('maxlength', 6);
         id('login').onkeypress = function(){
            mask( this, maskapenas_letras );}

        //EMAIL-------------
         id('email').setAttribute('maxlength', 100);

        //UF-------------
        id('UF').setAttribute('maxlength', 2);
        id('UF').onkeypress = function(){
            mask( this, maskapenas_letras );}

        //CIDADE-------------
        id('cidade').setAttribute('maxlength', 60);
       
         //BAIRRO-------------
         id('bairro').setAttribute('maxlength', 60);

        //RUA-------------
          id('rua').setAttribute('maxlength', 60);

        //NUMERO-----------
        id('numero_entrada').setAttribute('maxlength', 20);
        id('numero_entrada').onkeypress = function(){
            mask( this, maskapenas_numeros );}

        //SENHA-------------
          id('senha').setAttribute('maxlength', 15);

         //CONFIRMAR_SENHA-------------
         id('confsenha').setAttribute('maxlength', 15);

     
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////--------------------------------------------------------------------------   VALIDAÇÂO ---------------------------------------------------------------------------////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
//////////////////////////////////  VALIDAR SUBMIT ////////////////////////////////////////////////////////

validar_submit()//--------------------------------- EXECUTA FUNÇÃO SUBMIT AO ABRIR A PAGINA-------/

 //---------------- var validações ------------------//
var email_valido=false;
var sexo_valido= false;
var senha_valido= false;
var confsenha_valido= false;
var cpf_valido = false;
var nome_valido = false;
var nomemat_valido=false;
var tel_fixo_valido=false;  
var tel_cel_valido=false;
var login_valido=false;
var CEP_valido=false;

        function validar_submit(){///--------------------------------------------------------------- FUNÇÃO PARA HABILITAR SUBMIT----------//
            sexo();
            let valido=0;
            let input=document.getElementsByClassName("campos_obrigatorios");
           
            for (let index = 0; index < input.length; index++) {//----------LOCALIZA INPUTS VAZIOS-----//
                const campo = input[index];
                if(campo.value.replace(/\s+/g, '') == ''){
                    valido-=1;
                }
                else{valido+=1;}
            }
         
            if(valido == input.length && sexo_valido!=false && email_valido!= false && senha_valido!= false  //-----------REABILITA SUBMIT SE ATENDIDAS AS CONDIÇÕES----//
                && confsenha_valido!= false && cpf_valido!= false && nome_valido!= false
                && nomemat_valido!= false && tel_fixo_valido!= false && tel_cel_valido!= false
                && login_valido!= false && CEP_valido!=false ){
            id("botaocadastrar").removeAttribute("disabled",);
            }
       
            else{
            id("botaocadastrar").setAttribute("disabled", "disabled");//------------ SENÃO DESABILITA ---------////
            } }

            ///------------------------------------------------ executa a função submit----///
            const validateSUBMIT= () =>{ validar_submit();}
            id("body_cadastro").addEventListener('click', validateSUBMIT);
            const validateSubmit= () =>{ validar_submit();}
            id("body_cadastro").addEventListener('input', validateSubmit);
            const validateSUbmit= () =>{ validar_submit();}
            id("body_cadastro").addEventListener('keyup', validateSUbmit);
            const validateSUbmiT= () =>{ validar_submit();}
            id("body_cadastro").addEventListener('wheel', validateSUbmiT);
            const validateSUbmIT= () =>{ validar_submit();}
            id("body_cadastro").addEventListener('mousemove', validateSUbmIT);
       

///////////////////// NOME ///////////////////////////////////////////
const validateNome = (event) => {
    const input = event.currentTarget;
    const regex =/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/;
    const nomeTest = regex.test(input.value.replace(/\s+/g, ''));

    if(!nomeTest || input.value.length < 15) {
        nome_valido = false;
        id('span_nome').style.display='block';
        id('nome').classList.add('error_input');
        id('span_nome').innerHTML="Nome com menos de 15 caracteres.";
    } else {
        nome_valido = true;
       
        id('span_nome').style.display='none';
        id('nome').classList.remove('error_input');      
    }
}
    id("nome").addEventListener('input', validateNome);
 
///////////////////// NOME  DA MÃE //////////////////////////////////
const validateNomemat = (event) => {
    const input = event.currentTarget;
    const regex =/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/;
    const nomematTest = regex.test(input.value.replace(/\s+/g, ''));
   
    if(!nomematTest || input.value.length < 15) {
        nomemat_valido = false;
        id('span_nomemat').style.display='block';
        id('nomemat').classList.add('error_input');
        id('span_nomemat').innerHTML="Nome com menos de 15 caracteres.";
    } else {
        nomemat_valido = true;
        id('span_nomemat').style.display='none';
        id('nomemat').classList.remove('error_input');  
    }
}
    id("nomemat").addEventListener('input', validateNomemat);

////////////////////////////////////////DATA NASCIMENTO /////////////////
const validateDatansci= (event) =>{
    const input = event.currentTarget;
   
    if(input.value == '') {
        datanasci_valido=false;
         id('datanasci').classList.add('error_input');      
    }
    else{datanasci_valido=true;
        id('datanasci').classList.remove('error_input');}
  }
  id("datanasci").addEventListener('input', validateDatansci);


///////////////////// SEXO //////////////////////////////////////////

 function sexo(){

    if (document.getElementsByName("sexo")[0].checked == false
      && document.getElementsByName("sexo")[1].checked == false
      && document.getElementsByName("sexo")[2].checked == false) {
      sexo_valido=false;
    }
    else{sexo_valido=true}

  }

/////////////////////// CPF  ///////////////////////////////////

        //----------------------------------lógica CPF-------------//
        function validarCPF(cpf) {
            cpf = id("cpf").value.replace(/[^\d]+/g,'');
            if(cpf == '') return false;
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                    return false;
            // Valida 1o digito
            add = 0;
            for (i=0; i < 9; i ++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i ++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;  
        }
   

        //-------------------------------aminação//
        const validateCpf= () => {
           
                if(validarCPF() == false) {
                    cpf_valido=false  
                    id('span_cpf').style.display='block';
                    id('cpf').classList.add('error_input');
                    id('span_cpf').innerHTML="Você precisa informar um CPF válido.";
           
                } else {
                    cpf_valido=true
                    id('span_cpf').style.display='none';
                    id('cpf').classList.remove('error_input');
                }      
            }
            id("cpf").addEventListener('input', validateCpf);

///////////////////// TEL FIX //////////////////////////////////////////
const validateFix = (event) => {
    const input = event.currentTarget;
     
        if(input.value.length < 18) {
            tel_fixo_valido=false;
            id('span_tel_fixo').style.display='block';
            id('tel_fixo').classList.add('error_input');
            id('span_tel_fixo').innerHTML="O telefone fixo está imcompleto.";
        } else {
            tel_fixo_valido=true;
            id('span_tel_fixo').style.display='none';
            id('tel_fixo').classList.remove('error_input');
        }
    }
    id("tel_fixo").addEventListener('input', validateFix);

///////////////////// TEL CEL  //////////////////////////////////////////
const validateCel = (event) => {
    const input = event.currentTarget;
     
        if(input.value.length < 18) {
            tel_cel_valido=false;
            id('span_tel_cel').style.display='block';
            id('tel_cel').classList.add('error_input');
            id('span_tel_cel').innerHTML="O telefone celular está imcompleto.";
        } else {
            tel_cel_valido=true;
            id('span_tel_cel').style.display='none';
            id('tel_cel').classList.remove('error_input');
        }
    }
    id("tel_cel").addEventListener('input', validateCel);

/////////////////////////////// CEP ///////////////////////////////
const validateCEP = (event) => {
    const input = event.currentTarget;
     
        if(input.value.length != 9) {
            CEP_valido=false;
            id('CEP').classList.add('error_input');
        } else {
            CEP_valido=true;
            id('CEP').classList.remove('error_input');
        }
    }
    id("CEP").addEventListener('input', validateCEP);
   

////////////////////////// EMAIL /////////////////////////////////////////
const validateEmail = (event) => {
    const input = event.currentTarget;
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const emailTest = regex.test(input.value);
   
    if(!emailTest) {
        email_valido = false;
        id('span_email').style.display='block';
        id('email').classList.add('error_input');
        id('span_email').innerHTML="Você precisa informar um e-mail válido.";
    } else {
        email_valido = true;
        id('span_email').style.display='none';
        id('email').classList.remove('error_input');            
    }
}
 id("email").addEventListener('input', validateEmail);


///////////////////// LOGIN /////////////////////////////////////////////

const validateLogin = (event) => {
    const input = event.currentTarget;
    const regex =/^[A-Za-z ]+$/;
    const loginTest = regex.test(input.value);
   
     
        if(!loginTest ||input.value.length != 6) {
            login_valido=false;
            id('span_login').style.display='block';
            id('login').classList.add('error_input');
            id('span_login').innerHTML="O login deve possuir 6 caracteres e somente letras sem acento.";
        } else {
            login_valido=true;
            id('span_login').style.display='none';
            id('login').classList.remove('error_input');
        }
    }
    id("login").addEventListener('input', validateLogin);

///////////////////////////// SENHA ////////////////////////////////////////
     const validateSenha = (event) => {
        const input = event.currentTarget;
        const regex=/^(?=.*\d)[0-9a-zA-Z$*&@#]{8,15}$/;
        const senhaTest = regex.test(input.value);

        if(!senhaTest) {
            senha_valido=false;      
            id('span_senha').style.display='block';
            id('senha').classList.add('error_input');
            id('span_senha').innerHTML="Você precisa informar uma senha válida.";

        } else {
            senha_valido=true;
            id('span_senha').style.display='none';
            id('senha').classList.remove('error_input');
         
                   
                    if(id('confsenha').value != id("senha").value) {
                        confsenha_valido=false;
                        id('span_confsenha').style.display='block';
                        id('confsenha').classList.add('error_input');
                        id('span_confsenha').innerHTML="Senhas não conhecidem.";
                    } else {
                        confsenha_valido=true;
                        id('span_confsenha').style.display='none';
                        id('confsenha').classList.remove('error_input');
                    }
        }
    }
    id("senha").addEventListener('input', validateSenha);

///////////////////////   CONFIRMAÇÃO DA SENHA ////////////////////////////////
    const validateConfsenha = (event) => {
    const input = event.currentTarget;
       
        if(input.value != id("senha").value) {
            confsenha_valido=false;
            id('span_confsenha').style.display='block';
            id('confsenha').classList.add('error_input');
            id('span_confsenha').innerHTML="Senhas não conhecidem.";
        } else {
            confsenha_valido=true;
            id('span_confsenha').style.display='none';
            id('confsenha').classList.remove('error_input');
        }
    }
    id("confsenha").addEventListener('input', validateConfsenha);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////darck mode( SELECIONA DO CSS SALVO AO ABRIR A JANELA) //////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var darck_storage=localStorage.darck_mode;
var darck_data="desativado"
    if(darck_storage!="desativado"){
    id("estilo_css").href="css/darck.css";
    id('logo_header_img').src="img/telecall-logo-white.png";
        darck_data="ativado"
        localStorage.setItem("darck_mode",darck_data)
    }
    else{
  id("estilo_css").href="css/css.css";
  id('logo_header_img').src="img/logo_sem_fundo.png";
    darck_data="desativado"
    localStorage.setItem("darck_mode",darck_data)
    }
}//----fechamento da function_events-------//

window.onload =function_events;/////////////////////////////////////////////////////////// EXECUÇÃO DAS FUNCTION EVENTS AO ABRIR A JANELA /////////////