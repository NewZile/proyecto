let preguntas_aleatorias = true;
let mostrar_pantalla_juego_términado = true;
let reiniciar_puntos_al_reiniciar_el_juego = true;

window.addEventListener("load", function () {
  fetch("base-preguntas.json")
    .then(response => response.text())
    .then(base_preguntas => {
      interprete_bp = JSON.parse(base_preguntas);
      escogerPreguntaAleatoria();
    });
});

let pregunta;
let posibles_respuestas;
btn_correspondiente = [
  select_id("btn1"),
  select_id("btn2"),
  select_id("btn3"),
  select_id("btn4")
];
let npreguntas = [];

let preguntas_hechas = 0;
let preguntas_correctas = 0;

function escogerPreguntaAleatoria() {
  let n;
  if (preguntas_aleatorias) {
    n = Math.floor(Math.random() * interprete_bp.length);
  } else {
    n = 0;
  }

  if (npreguntas.length < interprete_bp.length) {
    while (npreguntas.includes(n)) {
      n++;
      if (n >= interprete_bp.length) {
        n = 0;
      }
    }
  } else {
    if (mostrar_pantalla_juego_términado) {
      swal.fire({
        title: "Juego finalizado",
        text:
          "Puntuación: " + preguntas_correctas + "/" + (preguntas_hechas - 1),
        icon: "success"
      });
    }
    if (reiniciar_puntos_al_reiniciar_el_juego) {
      preguntas_correctas = 0
      preguntas_hechas = 0
    }
    npreguntas = [];
    n = 0;
  }

  npreguntas.push(n);
  preguntas_hechas++;

  escogerPregunta(n);
}

function escogerPregunta(n) {
  pregunta = interprete_bp[n];
  select_id("categoria").innerHTML = pregunta.categoria;
  select_id("pregunta").innerHTML = pregunta.pregunta;
  select_id("numero").innerHTML = n;

  let pc = preguntas_correctas;
  let ph = preguntas_hechas;
  select_id("puntaje").innerHTML = ph > 1 ? pc + "/" + (ph - 1) : "";

  style("imagen").objectFit = pregunta.objectFit;
  desordenarRespuestas(pregunta);

  let imagen = select_id("imagen");
  if (pregunta.imagen) {
    imagen.setAttribute("src", pregunta.imagen);
    style("imagen").height = "200px";
    style("imagen").width = "100%";
  } else {
    style("imagen").height = "0px";
    style("imagen").width = "0px";
    setTimeout(() => {
      imagen.setAttribute("src", "");
    }, 500);
  }
}


function desordenarRespuestas(pregunta) {
  let posibles_respuestas = [pregunta.respuesta, pregunta.incorrecta1, pregunta.incorrecta2, pregunta.incorrecta3,];

  // Fisher-Yates shuffle
  for (let i = posibles_respuestas.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1));
    [posibles_respuestas[i], posibles_respuestas[j]] = [posibles_respuestas[j], posibles_respuestas[i]];
  }

  const buttonIds = ['btn1', 'btn2', 'btn3', 'btn4'];

  for (let i = 0; i < posibles_respuestas.length; i++) {
    select_id(buttonIds[i]).innerHTML = posibles_respuestas[i];
  }
}


let suspender_botones = false;

function oprimir_btn(i) {
  if (suspender_botones) {
    return;
  }
  suspender_botones = true;

  const btns = [...document.querySelectorAll(".respuestas button")];

  if (posibles_respuestas[i] === pregunta.respuesta) {
    preguntas_correctas++;
    btns[i].style.background = "lightgreen";
  } else {
    btns[i].style.background = "pink";
  }

  for (let j = 0; j < 4; j++) {
    if (posibles_respuestas[j] === pregunta.respuesta) {
      btns[j].style.background = "lightgreen";
      break;
    }
  }

  setTimeout(() => {
    reiniciar();
    suspender_botones = false;
  }, 3000);
}


// let p = prompt("numero")

function reiniciar() {
  for (const btn of btn_correspondiente) {
    btn.style.background = "white";
  }
  escogerPreguntaAleatoria();
}

function select_id(id) {
  return document.getElementById(id);
}

function style(id) {
  return select_id(id).style;
}

async function readText(ruta_local) {
  var texto = null;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", ruta_local, true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === XMLHttpRequest.DONE && xmlhttp.status === 200) {
      texto = xmlhttp.responseText;
    }
  };
  xmlhttp.send();
  return texto;
}
