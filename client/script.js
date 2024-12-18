let depositCount = 0;

function makeDeposit() {
  addDepositToService().then(response => {
    alert(response);
  });
}

function checkVoucher() {
  checkVoucherEligibility().then(response => {
    document.getElementById('voucher-notification').innerText = response;
  });
}

// Function to call the addDeposit method of the SOAP service
async function addDepositToService() {
  const url = "http://localhost:8080/soap/server.php";
  const soapEnvelope = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:vou="Voucher">
      <soapenv:Header/>
      <soapenv:Body>
        <vou:addDeposit/>
      </soapenv:Body>
    </soapenv:Envelope>
  `;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "text/xml; charset=utf-8",
      "SOAPAction": "addDeposit"
    },
    body: soapEnvelope
  });

  const text = await response.text();
  const parser = new DOMParser();
  const xmlDoc = parser.parseFromString(text, "text/xml");
  const result = xmlDoc.getElementsByTagName("return")[0].textContent;
  depositCount++;
  return result + depositCount;
}

// Function to call the checkVoucherEligibility method of the SOAP service
async function checkVoucherEligibility() {
  if (depositCount < 3) {
    return "You need to make 3 deposits before you can use a voucher.";
  }

  const url = "http://localhost:8080/soap/server.php";
  const soapEnvelope = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:vou="Voucher">
      <soapenv:Header/>
      <soapenv:Body>
        <vou:checkVoucherEligibility/>
      </soapenv:Body>
    </soapenv:Envelope>
  `;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "text/xml; charset=utf-8",
      "SOAPAction": "checkVoucherEligibility"
    },
    body: soapEnvelope
  });

  const text = await response.text();
  const parser = new DOMParser();
  const xmlDoc = parser.parseFromString(text, "text/xml");
  const result = xmlDoc.getElementsByTagName("return")[0].textContent;
  return result;
}
