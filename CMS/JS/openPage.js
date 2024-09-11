function mostrar_abas() {
  document.getElementById("aba_contatos").style.display = "none";
  document.getElementById("abaUsuarios").style.display = "none";
  document.getElementById("abaProtudos").style.display = "none";
  document.getElementById("div_aba4").style.display = "none";

  switch (obj.id) {
    case "mostra_aba_contatos":
      document.getElementById("aba_contatos").style.display = "block";
      document.querySelector("footer").style.display = "none";

      break;

    case "mostrar_abaUsuarios":
      document.getElementById("abaUsuarios").style.display = "block";
      document.querySelector("footer").style.display = "none";

      break;

    case "mostra_abaProtudos":
      document.getElementById("abaProtudos").style.display = "block";
      document.querySelector("footer").style.display = "none";

      break;

    case "mostra_abaConteudo":
      document.getElementById("div_aba4").style.display = "block";
      document.querySelector("footer").style.display = "none";

      break;
  }
}
