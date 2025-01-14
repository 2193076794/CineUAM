<div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
paypal.Button.render({
  env: '<?php echo PayPalENV; ?>',
  client: {
    <?php if(ProPayPal) { ?>  
    production: '<?php echo PayPalClientId; ?>'
    <?php } else { ?>
    sandbox: '<?php echo PayPalClientId; ?>'
    <?php } ?>  
  },
  style: {
    size: 'responsive', // Mantener responsive para ajustar el tamaño
    shape: 'rect', // Puedes usar 'rect' o 'pill'
    color: 'gold',  // Puedes usar 'gold', 'blue', 'silver' o 'black'
    layout: 'vertical' // Usar layout vertical
  },
  payment: function (data, actions) {
    return actions.payment.create({
      transactions: [{
        amount: {
          total: '<?php echo $productPrice; ?>',
          currency: '<?php echo $currency; ?>'
        }
      }]
    });
  },
  onAuthorize: function (data, actions) {
    return actions.payment.execute()
      .then(function () {
        window.location = "orderDetails.php?paymentID=" + data.paymentID + "&payerID=" + data.payerID + "&token=" + data.paymentToken + "&pid=<?php echo $productId; ?>";
      });
  }
}, '#paypal-button-container');
</script>
