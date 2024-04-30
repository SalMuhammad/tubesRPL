const keyword = document.querySelector('form input')
const constainer = document.querySelector('.container')

keyword.addEventListener('input', function(){
  // buat objek ajax
  let xhr = new XMLHttpRequest()

  // cek kesiapan ajax
  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
      constainer.innerHTML = xhr.responseText
    }
  }

  // eksekusi
  xhr.open('GET', 'ajax/mhs.php?keyword='+keyword.value, true)
  xhr.send()
})