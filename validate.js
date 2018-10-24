function validateForm(){
  var a = '';
  var userError = userValidation();
  var bookError = bookValidation();
  a = (userError.length==0)&&(bookError.length==0);
  if(userError.length!==0||bookError.length!==0){
    alert(userError + "\n" + bookError);
  }
  return a;
}

function userValidation(){
  var error = '';
  var dni = document.getElementById("userInput").value;
  dni = dni.toUpperCase();
  var number, let, letter;
    var dni_re = /^[XYZ]?\d{5,8}[A-Z]$/;

    if(dni_re.test(dni) === true){
        number = dni.substr(0,dni.length-1);
        number = number.replace('X', 0);
        number = number.replace('Y', 1);
        number = number.replace('Z', 2);
        let = dni.substr(dni.length-1, 1);
        number = number % 23;
        letter = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letter = letter.substring(number, number+1);
        if (letter != let) {
            error = "Usuario no válido";
          }else{}
    }else{
      error = "Usuario no válido";
    }
  return error;
}
function bookValidation(){
  var error = '';
  var book = document.getElementById("bookInput");
  if(book == ''){
    error = "No se ha introducido el ejemplar.";
  }else if(!(/^[0-9]{9}$/.test(book.value))){
    error = "Libro no válido";
  }
    return error;
}
