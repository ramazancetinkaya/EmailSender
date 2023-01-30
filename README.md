# EmailSender
Here's a sample email sending class using PHPMailer.

This class uses PHPMailer library to send email. It has the ability to add CC and BCC recipients, as well as handle basic email elements such as the sender, recipient, subject, and message.
You need to configure your server and account settings to send email using this class. Also, you need to require the library before using it.

You can also add attachments and custom headers using the PHPMailer library. You can also use different transport options like sendmail, mail, or use a service like Gmail, Amazon SES

## Example usage of the class:
```php
$sender = new EmailSender();
$sender->addCC('cc@example.com');
$sender->addBCC('bcc@example.com');
$sender->setSubject('Hello!');
$sender->setMessage('Hello, how are you?');
$sender->send();
```

### Authors

**Ramazan Çetinkaya**

- [github/ramazancetinkaya](https://github.com/ramazancetinkaya)

### License

Copyright © 2023, [Ramazan Çetinkaya](https://github.com/ramazancetinkaya).
