function onlyNumber(input) {

    var number = input.value.replace(/\D/g, "");
    input.value = number;
  }
