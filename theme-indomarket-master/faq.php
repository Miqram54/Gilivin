<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Accordion</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #f06, #f79);
        }

        .container {
            max-width: 600px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            padding: 20px;
            overflow: hidden;
        }

        .img-container {
            height: 180px;
            background: url('your-image-url.jpg') center/cover no-repeat;
            /* Replace with an actual image URL */
            border-radius: 12px 12px 0 0;
        }

        .faq {
            margin-top: -200px;
            padding: 20px;
        }

        .faq h2 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            padding: 20px 0;
        }

        .q-a {
            border-top: 1px solid #ddd;
            padding: 15px 0;
            transition: background-color 0.3s;
        }

        .q-a:hover {
            background-color: #f9f9f9;
        }

        .q-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .q-wrapper h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            transition: color 0.3s ease;
        }

        .q-wrapper h3.h3-active {
            color: #f47b56;
        }

        .q-wrapper svg {
            transition: transform 0.3s ease;
        }

        .q-wrapper svg.svg-animation {
            transform: rotate(180deg);
        }

        p {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #666;
            margin-top: 10px;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease, max-height 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }

        p.p-visible {
            display: block;
            opacity: 1;
            max-height: 200px;
        }

        .attribution {
            font-size: 0.8rem;
            text-align: center;
            margin-top: 20px;
        }

        .attribution a {
            color: #f47b56;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <article>
            <div class="img-container"></div>
            <div class="faq">
                <h2>FAQ</h2>
                <div class="q-a">
                    <div class="q-wrapper">
                        <h3 tabindex="0">Apa saja alat dasar yang dibutuhkan untuk bertani di lahan kecil?</h3>
                        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 .799l4 4 4-4" stroke="#F47B56" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </div>
                    <p hidden>Alat dasar yang biasanya dibutuhkan untuk lahan kecil antara lain cangkul, sekop, garu, semprotan hama, dan alat penyiram. Semua alat ini membantu memudahkan proses pengolahan tanah, penanaman, dan perawatan tanaman.</p>
                </div>

                <div class="q-a">
                    <div class="q-wrapper">
                        <h3 tabindex="0">Bagaimana cara memilih traktor yang sesuai dengan kebutuhan lahan?</h3>
                        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 .799l4 4 4-4" stroke="#F47B56" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </div>
                    <p hidden>Pilihan traktor tergantung pada ukuran lahan dan jenis tanaman yang akan ditanam. Untuk lahan kecil, traktor mini sudah memadai. Sementara untuk lahan besar atau perkebunan, traktor besar dengan daya lebih tinggi dan aksesoris tambahan lebih cocok.</p>
                </div>

                <div class="q-a">
                    <div class="q-wrapper">
                        <h3 tabindex="0">Apakah ada perawatan rutin untuk mesin penanam otomatis?</h3>
                        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 .799l4 4 4-4" stroke="#F47B56" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </div>
                    <p hidden>Ya, mesin penanam otomatis membutuhkan perawatan rutin, seperti pembersihan sisa-sisa tanah dan tanaman setelah digunakan, pemeriksaan pelumasan pada bagian bergerak, serta pengecekan komponen elektronik untuk memastikan kinerjanya tetap optimal.</p>
                </div>

                <div class="q-a">
                    <div class="q-wrapper">
                        <h3 tabindex="0">Berapa kapasitas maksimal alat pemanen padi otomatis?</h3>
                        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 .799l4 4 4-4" stroke="#F47B56" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </div>
                    <p hidden>Alat pemanen padi otomatis umumnya memiliki kapasitas antara 0,5 hingga 2 hektar per jam, tergantung pada ukuran dan model alat. Pemilihan kapasitas yang tepat membantu mengoptimalkan waktu dan tenaga kerja.</p>
                </div>

                <div class="q-a">
                    <div class="q-wrapper">
                        <h3 tabindex="0">Apakah alat semprot hama ramah lingkungan tersedia?</h3>
                        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 .799l4 4 4-4" stroke="#F47B56" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </div>
                    <p hidden>Ada beberapa jenis alat semprot hama yang ramah lingkungan, terutama yang menggunakan teknologi tekanan rendah dan penyemprotan yang efisien untuk mengurangi penggunaan pestisida. Alat-alat ini membantu mengurangi dampak negatif pestisida pada lingkungan.</p>
                </div>
            </div>
        </article>

        <footer class="attribution">
            <button onclick="goBack()" style="margin-bottom: 20px; padding: 10px 20px; border: none; background-color: #f47b56; color: #fff; border-radius: 5px; cursor: pointer;">Kembali</button>

            <p>Challenge by <a href="https://www.frontendmentor.io?ref=challenge" target="_blank">Frontend Mentor</a>.</p>
            <p>Coded by <a href="https://github.com/annafkt/frontend-mentor-challenges/tree/main/challenges/faq-accordion-card" target="_blank">annafkt</a>.</p>
        </footer>
    </div>
</body>

</html>
<script>
    function goBack() {
        window.history.back();
    }

    const questionWrappers = document.querySelectorAll('.q-wrapper');

    questionWrappers.forEach((wrapper) => {
        wrapper.addEventListener('click', showAnswer);
        wrapper.addEventListener('keydown', (e) => {
            if (e.key == 'Enter') {
                showAnswer(e);
            }
        });
    });

    function showAnswer(e) {
        questionWrappers.forEach((wrapper) => {
            if (wrapper == e.currentTarget) {
                wrapper.firstElementChild.classList.toggle('h3-active');
                wrapper.lastElementChild.classList.toggle('svg-animation');
                wrapper.nextElementSibling.classList.toggle('p-visible');
            } else {
                wrapper.firstElementChild.classList.remove('h3-active');
                wrapper.lastElementChild.classList.remove('svg-animation');
                wrapper.nextElementSibling.classList.remove('p-visible');
            }
        });
    }
</script>