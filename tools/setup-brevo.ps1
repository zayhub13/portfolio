$ErrorActionPreference = 'Stop'

Write-Host 'This setup stores SMTP credentials outside the public website folder.'
Write-Host 'Use a NEW Brevo SMTP key. Revoke any key previously shared in chat.'

$smtpUser = (Read-Host 'Brevo SMTP login').Trim()
$fromEmail = (Read-Host 'Sender email verified in Brevo').Trim()
if (-not $smtpUser -or $smtpUser.Length -gt 254) {
  throw 'Enter a valid Brevo SMTP login.'
}
if ($fromEmail -notmatch '^[^@\s]+@[^@\s]+\.[^@\s]+$' -or $fromEmail.Length -gt 254) {
  throw 'Enter a valid sender address verified in Brevo.'
}

$secureKey = Read-Host 'NEW Brevo SMTP key' -AsSecureString
if ($secureKey.Length -lt 20) {
  $secureKey.Dispose()
  throw 'The SMTP key looks too short. No configuration was saved.'
}

$bstr = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secureKey)
try {
  $smtpKey = [Runtime.InteropServices.Marshal]::PtrToStringBSTR($bstr)
} finally {
  [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstr)
  $secureKey.Dispose()
}

$configDirectory = Join-Path $env:LOCALAPPDATA 'JaiPortfolio'
$configPath = Join-Path $configDirectory 'mail-config.json'
New-Item -ItemType Directory -Path $configDirectory -Force | Out-Null

$identity = [Security.Principal.WindowsIdentity]::GetCurrent().Name
$directoryAcl = New-Object Security.AccessControl.DirectorySecurity
$directoryAcl.SetAccessRuleProtection($true, $false)
foreach ($principal in @($identity, 'SYSTEM', 'BUILTIN\Administrators')) {
  $rule = New-Object Security.AccessControl.FileSystemAccessRule(
    $principal,
    [Security.AccessControl.FileSystemRights]::FullControl,
    [Security.AccessControl.InheritanceFlags]'ContainerInherit, ObjectInherit',
    [Security.AccessControl.PropagationFlags]::None,
    [Security.AccessControl.AccessControlType]::Allow
  )
  $directoryAcl.AddAccessRule($rule)
}
Set-Acl -LiteralPath $configDirectory -AclObject $directoryAcl

$settings = @{
  smtp_user = $smtpUser
  smtp_key = $smtpKey
  from_email = $fromEmail
  from_name = 'Jai Ochoa Portfolio'
}
$json = ConvertTo-Json -InputObject $settings
[IO.File]::WriteAllText($configPath, $json, (New-Object Text.UTF8Encoding($false)))
Remove-Variable smtpKey, settings, json

[Environment]::SetEnvironmentVariable('PORTFOLIO_MAIL_CONFIG', $configPath, 'User')
$env:PORTFOLIO_MAIL_CONFIG = $configPath

Write-Host ''
Write-Host 'Private SMTP configuration saved outside the website folder.'
Write-Host 'Fully close and reopen XAMPP Control Panel, then stop and start Apache.'
Write-Host 'After Apache restarts, submit a test message through the contact form.'
