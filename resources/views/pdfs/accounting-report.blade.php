<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Comptable</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #af241c;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #af241c;
            letter-spacing: 1px;
        }
        h1 {
            font-size: 22px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
            color: #333;
        }
        .period {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-box {
            width: 22%;
            text-align: center;
            background: #f9f9f9;
            padding: 15px 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .stat-title {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #af241c;
        }
        .section {
            margin-bottom: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }
        .section-heading {
            background: #f2f2f2;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">HÔTEL BKBG</div>
            <p>Rapport Comptable</p>
        </div>
        
        <h1>Rapport financier des réservations</h1>
        
        <div class="period">
            Période du <strong>{{ $startDate }}</strong> au <strong>{{ $endDate }}</strong>
        </div>
        
        <div class="overview">
            <div class="stat-box">
                <div class="stat-title">Revenu Total</div>
                <div class="stat-value">{{ number_format($reportData['total_revenue'], 0, ',', ' ') }} FCFA</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-title">Réservations</div>
                <div class="stat-value">{{ $reportData['total_reservations'] }}</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-title">Nuitées</div>
                <div class="stat-value">{{ $reportData['total_nights'] }}</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-title">Revenu/Réservation</div>
                <div class="stat-value">{{ number_format($reportData['average_revenue_per_reservation'], 0, ',', ' ') }} FCFA</div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-heading">Répartition par catégorie de chambre</div>
            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th class="text-right">Réservations</th>
                        <th class="text-right">Revenu</th>
                        <th class="text-right">% du total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData['categories_stats'] as $category)
                        <tr>
                            <td>{{ $category['name'] }}</td>
                            <td class="text-right">{{ $category['reservations_count'] }}</td>
                            <td class="text-right">{{ number_format($category['revenue'], 0, ',', ' ') }} FCFA</td>
                            <td class="text-right">{{ number_format($category['percentage'], 1) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <div class="section-heading">Services additionnels</div>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th class="text-right">Nombre</th>
                        <th class="text-right">Revenu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData['services_stats'] as $service)
                        <tr>
                            <td>{{ $service['name'] }}</td>
                            <td class="text-right">{{ $service['count'] }}</td>
                            <td class="text-right">{{ number_format($service['revenue'], 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <div class="section-heading">Modes de paiement</div>
            <table>
                <thead>
                    <tr>
                        <th>Méthode</th>
                        <th class="text-right">Réservations</th>
                        <th class="text-right">Revenu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData['payment_methods_stats'] as $method)
                        <tr>
                            <td>{{ $method['method'] }}</td>
                            <td class="text-right">{{ $method['count'] }}</td>
                            <td class="text-right">{{ number_format($method['revenue'], 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="page-break"></div>
        
        <div class="section">
            <div class="section-heading">Revenus par jour</div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="text-right">Réservations</th>
                        <th class="text-right">Revenu estimé</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData['daily_revenue'] as $day)
                        <tr>
                            <td>{{ $day['date'] }}</td>
                            <td class="text-right">{{ $day['reservations'] }}</td>
                            <td class="text-right">{{ number_format($day['revenue'], 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>Rapport généré le {{ $generatedAt }}</p>
            <p>HÔTEL BKBG - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>