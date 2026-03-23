<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .contact-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .contact-header h1 {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .contact-header p {
            font-size: 1.1rem;
            color: #666;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-section {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .info-item {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .info-item h3 {
            font-size: 1.2rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .info-item p {
            color: #666;
            line-height: 1.6;
        }

        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
            }

            .contact-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="contact-container">
        <div class="contact-header">
            <h1>📞 Get In Touch</h1>
            <p>We'd love to hear from you. Reach out anytime!</p>
        </div>

        <div class="contact-content">
            <div class="info-section">
                <div class="info-item">
                    <h3>📍 Address</h3>
                    <p>123 I Don't Know St.<br>Boracay<br>Philippines</p>
                </div>

                <div class="info-item">
                    <h3>📧 Email</h3>
                    <p>support@pandorasproduce.com<br>info@pandorasproduce.com</p>
                </div>

                <div class="info-item">
                    <h3>📱 Phone</h3>
                    <p>+63 991 789 1359<br>Available Mon-Fri, 8AM-5PM EST</p>
                </div>

                <div class="info-item">
                    <h3>🕐 Business Hours</h3>
                    <p>Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday - Sunday: Closed</p>
                </div>
            </div>

            <div class="contact-form">
                <h2 style="color: #667eea; margin-bottom: 20px;">Send us a Message</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for reaching out! We\'ll get back to you soon.');
            this.reset();
        });
    </script>
</body>
</html>
