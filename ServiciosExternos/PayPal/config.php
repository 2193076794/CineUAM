<?php
if (!defined('ProPayPal')) {
    define('ProPayPal', 0);
}

if (ProPayPal) {
    if (!defined('PayPalClientId')) {
        define("PayPalClientId", "AfMI01SrYi6_dyUuBwZU9dkFSK_kqgVfCNbdW50Lkrdlz3NNlWnfo3DJRVQbfUpKcZAmpRiZePThhiKY");
    }
    if (!defined('PayPalSecret')) {
        define("PayPalSecret", "EJMEq66zgLDCnVfOPUUZu4sPsI6kdKNj7lZwA9w6HgD92_T9HuwCbJxdoEXv05SsjSoQVbdV5szgGqOX");
    }
    if (!defined('PayPalBaseUrl')) {
        define("PayPalBaseUrl", "https://api.paypal.com/v1/");
    }
    if (!defined('PayPalENV')) {
        define("PayPalENV", "production");
    }
} else {
    if (!defined('PayPalClientId')) {
        define("PayPalClientId", "AfMI01SrYi6_dyUuBwZU9dkFSK_kqgVfCNbdW50Lkrdlz3NNlWnfo3DJRVQbfUpKcZAmpRiZePThhiKY");
    }
    if (!defined('PayPalSecret')) {
        define("PayPalSecret", "EJMEq66zgLDCnVfOPUUZu4sPsI6kdKNj7lZwA9w6HgD92_T9HuwCbJxdoEXv05SsjSoQVbdV5szgGqOX");
    }
    if (!defined('PayPalBaseUrl')) {
        define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
    }
    if (!defined('PayPalENV')) {
        define("PayPalENV", "sandbox");
    }
}
?>