// ==========================================
// LOGIKA PADAHALAMAN UTAMA
// ==========================================

document.addEventListener("DOMContentLoaded", function () {
  const tombolShout = document.getElementById("btn-shout");

  if (tombolShout) {
    tombolShout.addEventListener("click", function () {
      alert("Hai, Selamat datang di Sistem Sederhana");
    });
  }
});

// ==========================================
// UNTUK HALAMAN MENU LOGIKANYA
// ==========================================

document.addEventListener("DOMContentLoaded", function () {
  const tombolShout = document.getElementById("btn-shout");
  if (tombolShout) {
    tombolShout.addEventListener("click", function () {
      alert("Hai, Selamat datang di Sistem Sederhana");
    });
  }

  const qtyMie = document.getElementById("qty-mie");
  const qtyLontong = document.getElementById("qty-lontong");
  const qtySpagethi = document.getElementById("qty-spagethi");

  const fieldTotal = document.getElementById("jumlah-total");
  const fieldDiskon = document.getElementById("diskon");
  const fieldBayar = document.getElementById("jumlah-bayar");

  const btnReset = document.getElementById("btn-reset");

  if (qtyMie) {
    alert("Input Jumlah Pesanan agar dihitung Otomatis oleh Sistem");

    const hargaMie = 12000;
    const hargaLontong = 10000;
    const hargaSpagethi = 15000;

    function hitungTotal() {
      let b = parseInt(qtyMie.value) || 0;
      let s = parseInt(qtyLontong.value) || 0;
      let m = parseInt(qtySpagethi.value) || 0;

      if (b < 0) {
        b = 0;
        qtyMie.value = 0;
      }
      if (s < 0) {
        s = 0;
        qtyLontong.value = 0;
      }
      if (m < 0) {
        m = 0;
        qtySpagethi.value = 0;
      }

      let total = b * hargaMie + s * hargaLontong + m * hargaSpagethi;

      let diskon = 0;
      if (total > 50000) {
        diskon = total * 0.1;
      }

      let bayar = total - diskon;

      fieldTotal.value = total;
      fieldDiskon.value = diskon;
      fieldBayar.value = bayar;
    }

    qtyMie.addEventListener("input", hitungTotal);
    qtyLontong.addEventListener("input", hitungTotal);
    qtySpagethi.addEventListener("input", hitungTotal);

    btnReset.addEventListener("click", function () {
      qtyMie.value = 0;
      qtyLontong.value = 0;
      qtySpagethi.value = 0;
      hitungTotal();
    });
  }
});

// ==========================================
// LOGIKA UNTUK HALAMAN CALCULATOR
// ==========================================
const calcIn1 = document.getElementById("calc-in1");
const calcIn2 = document.getElementById("calc-in2");
const calcOp = document.getElementById("calc-op");
const calcOut = document.getElementById("calc-out");
const btnHitung = document.getElementById("btn-hitung");
const btnResetCalc = document.getElementById("btn-reset-calc");

if (calcIn1) {
  btnHitung.addEventListener("click", function () {
    const val1 = calcIn1.value;
    const val2 = calcIn2.value;

    if (val1 === "" || val2 === "") {
      alert("Inputan tidak boleh kosong!");
      return;
    }

    const num1 = parseFloat(val1);
    const num2 = parseFloat(val2);

    if (num1 <= 0 || num2 <= 0) {
      alert("inputan pertama dan kedua harus lebih dari 0");
      return;
    }

    let result = 0;
    const op = calcOp.value;

    if (op === "*") {
      result = num1 * num2;
    } else if (op === "/") {
      result = num1 / num2;
    } else if (op === "+") {
      result = num1 + num2;
    } else if (op === "-") {
      result = num1 - num2;
    } else if (op === "%") {
      result = num1 % num2;
    } else if (op === "^") {
      result = num1 ** num2;
    }

    calcOut.value = result;
  });

  btnResetCalc.addEventListener("click", function () {
    calcIn1.value = "";
    calcIn2.value = "";
    calcOp.value = "*";
    calcOut.value = "";
  });
}

// ==========================================
// LOGIKA UNTUK HALAMAN GARIS HIDUP
// ==========================================
const ghTgl = document.getElementById("gh-tgl");
const ghBln = document.getElementById("gh-bln");
const ghThn = document.getElementById("gh-thn");
const btnKirimGh = document.getElementById("btn-kirim-gh");
const btnResetGh = document.getElementById("btn-reset-gh");
const ghOutputSection = document.getElementById("gh-output-section");

const outTgl = document.getElementById("out-tgl");
const outBln = document.getElementById("out-bln");
const outThn = document.getElementById("out-thn");
const outH1 = document.getElementById("out-h1");
const outH2 = document.getElementById("out-h2");
const outHAkhir = document.getElementById("out-hakhir");
const outNum = document.getElementById("out-num");
const ghResultDesc = document.getElementById("gh-result-desc");

if (ghTgl) {
  btnKirimGh.addEventListener("click", function () {
    const tglVal = ghTgl.value;
    const blnVal = ghBln.value;
    const thnVal = ghThn.value;

    if (tglVal === "" || thnVal === "") {
      alert("Mohon lengkapi tanggal dan tahun lahir!");
      return;
    }

    const rawString = String(tglVal) + String(blnVal) + String(thnVal);

    let sum1 = 0;
    for (let char of rawString) {
      sum1 += parseInt(char);
    }

    let sum2 = 0;
    if (sum1 > 9) {
      for (let char of String(sum1)) {
        sum2 += parseInt(char);
      }
    } else {
      sum2 = sum1;
    }

    let finalSum = 0;
    if (sum2 > 9) {
      for (let char of String(sum2)) {
        finalSum += parseInt(char);
      }
    } else {
      finalSum = sum2;
    }

    outTgl.value = tglVal;
    outBln.value = blnVal;
    outThn.value = thnVal;
    outH1.value = sum1;
    outH2.value = sum2;
    outHAkhir.value = finalSum;
    outNum.textContent = finalSum;

    let desc = "";
    switch (finalSum) {
      case 1:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 1, kepemimpinan, kemandirian, dan orisinalitas adalah tema utama dalam hidup. Anda dilahirkan untuk menjadi inisiator dan pelopor yang membuka jalan bagi orang lain. Orang-orang dengan garis hidup 1 memiliki dorongan kuat untuk sukses, penuh inovasi, dan sangat mandiri dalam mengambil keputusan. Anda tidak suka diatur dan lebih memilih untuk berdiri di atas kaki sendiri.\n\nMisi yang harus dicapainya dalam hidup adalah belajar mengandalkan diri sendiri dan menjadi pemimpin yang bijak tanpa menjadi diktator. Sisi cerah bagi orang-orang ini adalah keberanian untuk mengambil risiko dan kemampuan untuk mengubah ide brilian menjadi kenyataan. Karakter mereka tegas, ambisius, penuh tekad, dan selalu memiliki visi yang jelas ke depan.";
        break;
      case 2:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 2, harmoni, diplomasi, dan kerja sama adalah pelajaran berharga yang harus dijalani. Anda adalah pembawa damai alami yang memiliki kepekaan luar biasa terhadap perasaan dan kebutuhan orang lain. Orang-orang dengan garis hidup 2 sangat unggul dalam kemitraan dan mampu melihat berbagai sisi dari sebuah argumen, menjadikannya mediator yang sangat hebat.\n\nMisi yang harus dicapainya dalam hidup adalah menciptakan keseimbangan dan kedamaian di lingkungan sekitarnya. Sisi cerah bagi orang-orang ini adalah empati yang mendalam, kesabaran, dan kemampuan luar biasa untuk mendukung orang-orang terkasih. Mengasah intuisi dan belajar untuk tidak terlalu sensitif adalah kunci keberhasilan Anda. Karakter mereka lembut, kooperatif, penuh kasih sayang, dan pendengar yang setia.";
        break;
      case 3:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 3, ekspresi, sosialisasi, dan kreativitas sebagai pelajaran yang harus tempuh dalam hidupnya. Entertainer kelas dunia, orang-orang yang berkilau dan optimistik termasuk di dalamnya. Orang-orang dengan garis hidup 3 yang telah mengasah bakatnya mempunyai bakat kreatif yang istimewa. Biasanya dalam verbal, tulisan, akting, atau semacamnya.\n\nMisi yang harus dicapainya dalam hidup adalah kesuksesan dalam berekspresi. Sisi cerah bagi orang-orang bertema harmoni, keindahan dan kesenangan, serta membagi kemampuan kreatif Anda dengan dunia. Mengasah kemampuan Anda dalam ekspresi kreatif adalah misi tertinggi bagi angka garis hidup ini. Karakter mereka hangat dan bersahabat, pembicara yang baik, sosial dan terbuka.";
        break;
      case 4:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 4, keteraturan, stabilitas, dan kerja keras adalah pondasi utama dalam kehidupan. Anda adalah sosok yang sangat praktis, logis, dan dapat diandalkan dalam segala situasi. Orang-orang dengan garis hidup 4 adalah pembangun masyarakat yang sangat menghargai struktur, disiplin, dan dedikasi yang konsisten dalam mencapai tujuan jangka panjang.\n\nMisi yang harus dicapainya dalam hidup adalah membangun fondasi yang kokoh dan aman, baik untuk diri sendiri maupun orang lain. Sisi cerah bagi orang-orang ini adalah ketekunan yang tak tergoyahkan dan kemampuan untuk mewujudkan rencana yang paling rumit sekalipun. Menghindari sikap terlalu kaku atau keras kepala adalah tantangan terbesar Anda. Karakter mereka jujur, setia, pekerja keras, dan sangat terorganisir.";
        break;
      case 5:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 5, kebebasan, petualangan, dan perubahan adalah esensi dari perjalanan hidup mereka. Anda adalah jiwa yang dinamis, sangat mudah beradaptasi, dan memiliki rasa ingin tahu yang tak terbatas terhadap dunia. Orang-orang dengan garis hidup 5 sangat menyukai keragaman, bepergian, dan bersosialisasi, serta selalu mencari pengalaman baru yang mendebarkan.\n\nMisi yang harus dicapainya dalam hidup adalah mengeksplorasi makna kebebasan yang konstruktif dan belajar melalui pengalaman langsung. Sisi cerah bagi orang-orang ini adalah energi yang menular, karisma yang kuat, dan kemampuan untuk membawa perubahan positif di lingkungannya. Menjaga fokus dan tidak mudah bosan adalah pelajaran penting bagi Anda. Karakter mereka progresif, cerdas, berani, dan selalu antusias.";
        break;
      case 6:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 6, cinta kasih, tanggung jawab, dan pengasuhan adalah pilar utama dalam kehidupan. Anda memiliki insting alami untuk melindungi, merawat, dan memberikan kenyamanan bagi orang-orang di sekitar Anda. Orang-orang dengan garis hidup 6 sering kali menjadi perekat dalam keluarga atau komunitas, selalu siap berkorban demi kebahagiaan dan kesejahteraan bersama.\n\nMisi yang harus dicapainya dalam hidup adalah memberikan pelayanan dengan penuh kasih tanpa melupakan kebutuhan diri sendiri. Sisi cerah bagi orang-orang ini adalah kemampuan untuk menyembuhkan, memberikan nasihat yang bijak, dan menciptakan lingkungan yang hangat serta harmonis. Belajar untuk tidak terlalu mencampuri urusan orang lain adalah tantangan Anda. Karakter mereka penuh simpati, protektif, idealis, dan sangat bertanggung jawab.";
        break;
      case 7:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 7, analisis, spiritualitas, dan pencarian kebenaran adalah fokus utama dalam hidup. Anda adalah seorang pemikir yang mendalam, selalu mempertanyakan alasan di balik segala sesuatu, dan memiliki ketertarikan kuat pada misteri kehidupan. Orang-orang dengan garis hidup 7 mengandalkan intelektualitas dan intuisi yang tajam untuk membedah dunia di sekitar mereka.\n\nMisi yang harus dicapainya dalam hidup adalah menemukan kebijaksanaan batin dan memahami dunia yang tak terlihat. Sisi cerah bagi orang-orang ini adalah kemampuan analitis yang brilian, pemikiran yang filosofis, dan wawasan spiritual yang luas. Menghindari isolasi diri dan kecenderungan untuk terlalu sinis adalah pelajaran penting bagi garis hidup ini. Karakter mereka perfeksionis, introspektif, logis, dan sangat pengamat.";
        break;
      case 8:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 8, ambisi, kesuksesan materi, dan kepemimpinan eksekutif adalah dorongan terbesar dalam hidup. Anda memiliki bakat alami dalam mengelola bisnis, keuangan, dan sumber daya alam dengan efisiensi yang luar biasa. Orang-orang dengan garis hidup 8 memahami dunia materi dengan sangat baik dan memiliki visi besar serta kekuatan untuk mewujudkannya.\n\nMisi yang harus dicapainya dalam hidup adalah mencapai keseimbangan antara kekayaan materi dan nilai-nilai spiritual, serta menggunakan kekuasaan untuk kebaikan. Sisi cerah bagi orang-orang ini adalah mentalitas yang tangguh, kemampuan memecahkan masalah berskala besar, dan otoritas yang kuat. Menghindari sifat serakah atau terlalu mendominasi adalah ujian terbesar Anda. Karakter mereka profesional, realistis, percaya diri, dan sangat berorientasi pada tujuan.";
        break;
      case 9:
        desc =
          "Bagi mereka yang jumlah angka hari lahirnya 9, kemanusiaan, idealisme, dan kasih sayang universal adalah panggilan jiwa tertinggi. Anda adalah sosok yang sangat dermawan, toleran, dan memiliki keinginan mendalam untuk membuat dunia menjadi tempat yang lebih baik. Orang-orang dengan garis hidup 9 memiliki wawasan yang sangat luas dan mampu melihat gambaran besar dari setiap peristiwa kehidupan.\n\nMisi yang harus dicapainya dalam hidup adalah melepaskan ego, memaafkan, dan memberikan cinta tanpa syarat kepada sesama. Sisi cerah bagi orang-orang ini adalah jiwa artistik yang kuat, empati yang tak terbatas, dan kemampuan untuk menginspirasi orang banyak. Belajar untuk melepaskan masa lalu dan tidak terlalu emosional adalah kunci kedamaian Anda. Karakter mereka romantis, welas asih, tanpa pamrih, dan sangat karismatik.";
        break;
    }

    ghResultDesc.innerText = desc;

    ghOutputSection.style.display = "block";
  });

  btnResetGh.addEventListener("click", function () {
    ghTgl.value = "";
    ghBln.value = "1";
    ghThn.value = "";
    ghOutputSection.style.display = "none";
  });
}