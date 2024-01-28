function MascaraTelefone(objeto){
    if(objeto.value.length == 0)
      objeto.value = '(' + objeto.value;
 
    if(objeto.value.length == 3 )
       objeto.value = objeto.value + ')';
 
  if(objeto.value.length == 8)
      objeto.value = objeto.value + '-';
 }