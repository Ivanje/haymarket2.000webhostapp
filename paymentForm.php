<form action="paymentBack.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_tMPXbWHT1LN9kDSsJVfNRHGl"
    data-amount= <?php echo ($_SESSION['total_price']*100) ?>
    data-currency='EUR'
    data-email= <?php echo $_SESSION['email'] ?>
    data-name="Haymarket"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    >
  </script>
</form>