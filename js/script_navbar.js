/*//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////              NavBar                     ////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

///////////////////////////////////animação///////////////
const btnMobile = document.getElementById('btn-mobile');

function toggleMenu(event) {
  if (event.type === 'touchstart') event.preventDefault();
  const nav = document.getElementById('nav');
  nav.classList.toggle('active');
  const active = nav.classList.contains('active');
  event.currentTarget.setAttribute('aria-expanded', active);
  if (active) {
    event.currentTarget.setAttribute('aria-label', 'Fechar Menu');
  } else {
    event.currentTarget.setAttribute('aria-label', 'Abrir Menu');
  }
}

btnMobile.addEventListener('click', toggleMenu);
btnMobile.addEventListener('touchstart', toggleMenu);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////           darck mode                          //////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function darck_mode(){
  var darck_storage=localStorage.darck_mode;
  var darck_data="desativado"
  if(darck_storage=="desativado"){
  document.getElementById("estilo_css").href="css/darck.css";
  document.getElementById('logo_header_img').src="img/telecall-logo-white.png";
  darck_data="ativado"
  localStorage.setItem("darck_mode",darck_data)
 
  }

  else{document.getElementById("estilo_css").href="css/css.css";
  document.getElementById('logo_header_img').src="img/logo_sem_fundo.png";
  darck_data="desativado"
  localStorage.setItem("darck_mode",darck_data)
 
  }
 
}

window.onload= function(){//////////////////// (usa o CSS salvo ao abrir a janela ) ////////////////
  var darck_storage=localStorage.darck_mode;
  var darck_data="desativado"
  if(darck_storage!="desativado"){
  document.getElementById("estilo_css").href="css/darck.css";
  document.getElementById('logo_header_img').src="img/telecall-logo-white.png";
  darck_data="ativado"
  localStorage.setItem("darck_mode",darck_data)
  }

  else{
  document.getElementById("estilo_css").href="css/css.css";
  document.getElementById('logo_header_img').src="img/logo_sem_fundo.png";
  darck_data="desativado"
  localStorage.setItem("darck_mode",darck_data)
  }
 
}