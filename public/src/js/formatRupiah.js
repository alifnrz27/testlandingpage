function formatRupiah(input) {

    var number = input.value.replace(/\D/g, "");
    number = new Intl.NumberFormat('id-ID').format(number);
    input.value = number;
  }
