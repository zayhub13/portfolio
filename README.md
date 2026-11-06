# Portfolio contact mail setup

The contact form sends mail through Brevo SMTP. It does not open the visitor's
email application.

## Requirements

- PHP with the OpenSSL extension enabled
- Composer dependencies installed (`composer install`)
- A Brevo SMTP login and SMTP key
- A sender address verified in Brevo

## Local Windows/XAMPP setup

1. Revoke any SMTP key that was shared in chat or otherwise exposed, then create
   a new SMTP key in Brevo.
2. Verify a sender email address in Brevo.
3. From the project folder, run:

   ```powershell
   powershell -ExecutionPolicy Bypass -File .\tools\setup-brevo.ps1
   ```

   Enter the Brevo SMTP login and verified sender address when prompted. Paste
   the **new** SMTP key into the secure prompt; it will not be echoed.
4. Fully close and reopen XAMPP Control Panel, then stop and start Apache so it
   receives the private configuration path.
5. Submit a test message through the Contact page.

The setup stores the SMTP settings in a JSON file under your Windows
`%LOCALAPPDATA%\JaiPortfolio` folder, outside the public website directory.
The folder ACL is limited to your Windows account, SYSTEM, and local
Administrators. The application receives only the config file path through the
`PORTFOLIO_MAIL_CONFIG` environment variable. Do not move the secrets into the
website folder or commit them.

The message recipient is `johnjairuhochoa@gmail.com`, the subject is fixed to
`portfolio`, and the visitor's email is set as Reply-To.

## Other PHP hosting

On other hosts, set `BREVO_SMTP_USER`, `BREVO_SMTP_KEY`, `BREVO_FROM_EMAIL`,
and optionally `BREVO_FROM_NAME` through the host's private environment-variable
settings. Do not expose the SMTP key in a public configuration file.

## Deploying this PHP site to Vercel

The project root now includes `Dockerfile`, `Caddyfile`, and `.dockerignore`.
They package the existing PHP pages and run them with FrankenPHP using Vercel's
Container Runtime. This Vercel runtime is currently in beta.

1. Push the project to a GitHub repository and import it in Vercel. Select the
   project root as the Root Directory; Vercel should detect the root
   `Dockerfile` and use the Container preset.
2. In Vercel **Project Settings → Environment Variables**, add
   `BREVO_SMTP_USER`, `BREVO_SMTP_KEY`, and `BREVO_FROM_EMAIL`. Add
   `BREVO_FROM_NAME` if desired. Use the SMTP login, a newly generated SMTP key,
   and a sender address verified in Brevo. Never upload the local
   `%LOCALAPPDATA%\JaiPortfolio\mail-config.json` file or set
   `PORTFOLIO_MAIL_CONFIG` on Vercel.
3. Redeploy after adding the variables, then test the site and contact form.

The contact form currently uses PHP file-backed sessions for its CSRF token and
short cooldown. Vercel container instances can scale independently, so sessions
are not guaranteed to be shared between instances. For reliable production
submissions across multiple instances, configure a shared session store or move
the form's CSRF and rate limiting to a shared service before relying on it.
