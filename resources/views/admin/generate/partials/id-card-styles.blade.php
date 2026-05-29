<style>
.id-card {
    width: 100%;
    max-width: 420px;
    height: 650px;
    background: #f2f2f2;
    border-radius: 12px;
    padding: 10px;
    position: relative;
    border: 2px solid #111;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin: auto;
    font-family: Arial, sans-serif;
}

.top-header {
    text-align: center;
    position: relative;
    padding-bottom: 0;
    border-bottom: 2px solid #111;
}

.top-header h1 {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 5px;
}

.top-header h2 {
    font-size: 11px;
    font-weight: normal;
    color: #333;
}

.logo-left,
.logo-right {
    width: 40px;
    height: 40px;
    border-radius: 56%;
    position: absolute;
    top: 0;
    object-fit: contain;
    background: white;
    border: 2px solid #ccc;
    padding: 3px;
}

.logo-left {
    left: 0;
}

.logo-right {
    right: 0;
}

.photo-box {
    width: 130px;
    height: 148px;
    margin: 30px auto;
    border: 3px solid #222;
    border-radius: 15px;
    overflow: hidden;
    background: white;
}

.photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.details {
    margin-top: 5px;
    padding: 0 10px;
    min-height: 220px;
}

.detail-row {
    display: block;
    margin-bottom: 12px;
    font-size: 17px;
    clear: both;
}

.label {
    display: inline-block;
    width: 130px;
    font-weight: bold;
    font-size: 14px;
    color: #333;
    vertical-align: top;
}

.value {
    display: inline-block;
    width: 245px;
    font-size: 14px;
    color: #333;
    vertical-align: top;
    word-wrap: break-word;
}

.dates {
    margin-top: 5px;
    padding: 0 10px;
}

.bottom-section {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    height: 65px;
    border-top: 2px solid #111;
    padding-top: 15px;
    display: block;
}

.qr-box {
    position: absolute;
    left: 0;
    top: 15px;
    width: 50px;
    height: 50px;
}

.qr-box svg,
.qr-box img {
    width: 50px;
    height: 50px;
}

.signature {
    position: absolute;
    right: 0;
    top: 48px;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
}

.id-card-page {
    page-break-inside: avoid;
    margin-bottom: 24px;
}
</style>
