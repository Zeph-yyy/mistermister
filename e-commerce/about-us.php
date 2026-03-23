<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Pandora's Produce</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .about-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .about-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .about-header h1 {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .about-header p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .about-sections {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .about-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .about-section h2 {
            font-size: 1.5rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .about-section p {
            color: #666;
            line-height: 1.8;
            font-size: 1rem;
        }

        .mission-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 40px;
        }

        .mission-box h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: white;
        }

        .mission-box p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.95);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .value-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .value-card h3 {
            font-size: 1.1rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .value-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .about-sections {
                grid-template-columns: 1fr;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            .about-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="about-container">
        <div class="about-header">
            <h1>🌿 About Pandora's Produce</h1>
            <p>We're passionate about delivering the freshest, most nutritious organic fruits and vegetables straight to your doorstep.</p>
        </div>

        <div class="mission-box">
            <h2>Our Mission</h2>
            <p>To make organic, farm-fresh produce accessible to everyone by partnering with trusted local farmers and delivering quality products with exceptional service.</p>
        </div>

        <div class="about-sections">
            <div class="about-section">
                <h2>🌱 Our Story</h2>
                <p>Pandora's Produce was founded with a simple belief: healthy food should be easy to access. We started as a small operation connecting local organic farmers with families who care about what they eat. Today, we're proud to serve thousands of customers with the freshest produce and best customer service in the industry.</p>
            </div>

            <div class="about-section">
                <h2>🎯 Why Choose Us?</h2>
                <p>Every product is hand-picked for quality and freshness. We work directly with certified organic farms, ensuring pesticide-free, nutrient-rich produce. Our commitment to sustainability and customer satisfaction makes us the trusted choice for organic food.</p>
            </div>
        </div>

        <h2 style="text-align: center; font-size: 1.8rem; color: #667eea; margin-bottom: 30px;">Our Core Values</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3>🥗 Quality</h3>
                <p>We never compromise on the freshness and nutritional value of our products.</p>
            </div>
            <div class="value-card">
                <h3>♻️ Sustainability</h3>
                <p>Eco-friendly farming practices and sustainable packaging matter to us.</p>
            </div>
            <div class="value-card">
                <h3>💚 Trust</h3>
                <p>Transparency and honesty in everything we do, from farm to table.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
