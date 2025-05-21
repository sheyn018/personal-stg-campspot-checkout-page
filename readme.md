# Deployment Guide: Staging to Production

This document outlines the key changes needed to successfully deploy the **Campspot checkout page** from the staging to the production environment.

---

## 1. Update Payment Gateway Configuration

In `public/booking-checkout.php`, make the following changes:

### 1.1 CardConnect iFrame URL

Change the CardConnect tokenizer URL from staging to production:

```php
<!-- Change this: -->
<iframe title="CardConnect Card Number" id="tokenFrame" name="tokenFrame" frameborder="0" scrolling="no" 
class="checkout-form-field-cardconnect-iframe app-cc-iframe" 
src="https://boltgw-uat.cardconnect.com/itoke/ajax-tokenizer.html?tokenizewheninactive=true&amp;inactivityto=3000&amp;css=...">
</iframe>

<!-- To this: -->
<iframe title="CardConnect Card Number" id="tokenFrame" name="tokenFrame" frameborder="0" scrolling="no" 
class="checkout-form-field-cardconnect-iframe app-cc-iframe" 
src="https://boltgw.cardconnect.com/itoke/ajax-tokenizer.html?tokenizewheninactive=true&amp;inactivityto=3000&amp;css=...">
</iframe>
```

### 1.2 Message Event Validation

```js
// Change this:
if (event.origin !== "https://boltgw-uat.cardconnect.com")

// To this:
if (event.origin !== "https://boltgw.cardconnect.com")
```

---

## 2. Update Environment Settings

Ensure the `$environment` variable is properly set for production:

```js
const environment = getParameterByName('environment') || 'campspot';
```

---

## 3. Update API Endpoint Base URL

Update the base URL for API endpoints in production:

```js
// Change any hardcoded staging URL:
let baseurl = "https://personal-stg-campspot-checkout-page.onrender.com";

// To production URL:
let baseurl = "https://your-production-domain.com"; // Replace with actual production domain
```

---

## 4. Update Configuration Files

### 4.1 `constants.php`

File path: `ip server > endpoints > campspot-parkName`

Update API keys and URLs:

```php
<?php
// Change from staging values:
define('CAMPSPOT_API_KEY', 'staging-api-key');
define('CAMPSPOT_API_URL', 'https://api-staging.campspot.com');
define('CARD_CONNECT_API_KEY', 'staging-card-connect-key');

// To production values:
define('CAMPSPOT_API_KEY', 'production-api-key');
define('CAMPSPOT_API_URL', 'https://api.campspot.com');
define('CARD_CONNECT_API_KEY', 'production-card-connect-key');
?>
```

---

## 5. Update API Keys in Kinsta

If you're using **Kinsta** as your hosting provider:

* Log in to your Kinsta dashboard
* Navigate to your production site's environment variables
* Update the following keys:

  * `CAMPSPOT_API_KEY`
  * `CARD_CONNECT_API_KEY`
  * `CARD_CONNECT_MERCHANT_ID`
  * Any other environment-specific keys

---

## 6. Testing Checklist

After deployment, verify the following:

* [ ] Payment form loads correctly
* [ ] Credit card tokenization works
* [ ] Promo codes can be applied
* [ ] Orders can be completed successfully
* [ ] Confirmation page shows correct information
* [ ] Email confirmations are sent correctly