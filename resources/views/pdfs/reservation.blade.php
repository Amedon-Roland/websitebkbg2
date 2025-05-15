<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de réservation</title>
    <style>
        :root {
            --primary: #570DF8;
            --primary-focus: #4406CB;
            --primary-content: #ffffff;
            --secondary: #F000B8;
            --accent: #37CDBE;
            --neutral: #3D4451;
            --base-100: #ffffff;
            --base-200: #F2F2F2;
            --base-300: #E5E6E6;
            --base-content: #1f2937;
            --info: #3ABFF8;
            --success: #36D399;
            --warning: #FBBD23;
            --error: #F87272;
        }
        
        body {
            font-family: 'Helvetica', sans-serif;
            color: var(--base-content);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: var(--base-100);
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            background-color: var(--primary);
            color: var(--primary-content);
            border-radius: 12px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .card {
            background-color: var(--base-100);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 24px;
            overflow: hidden;
        }
        
        .card-header {
            padding: 16px 20px;
            background-color: var(--primary);
            color: var(--primary-content);
            font-weight: bold;
            font-size: 18px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .divider {
            height: 1px;
            background-color: var(--base-300);
            margin: 16px 0;
        }
        
        h1 {
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: var(--primary);
            color: var(--primary-content);
            border-radius: 16px;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .badge-lg {
            padding: 8px 16px;
            font-size: 16px;
        }
        
        .badge-center {
            display: block;
            width: fit-content;
            margin: 0 auto 20px auto;
        }
        
        .detail-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        
        .detail-row {
            display: table-row;
        }
        
        .detail-label {
            display: table-cell;
            font-weight: bold;
            padding: 8px 0;
            width: 40%;
        }
        
        .detail-value {
            display: table-cell;
            padding: 8px 0;
        }
        
        .price-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .price-table tr {
            border-bottom: 1px solid var(--base-300);
        }
        
        .price-table tr:last-child {
            border-bottom: none;
        }
        
        .price-table td {
            padding: 12px 8px;
        }
        
        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--base-300);
        }
        
        .price-row:last-child {
            border-bottom: none;
        }
        
        .price-row.total {
            font-weight: bold;
            border-top: 2px solid var(--base-300);
            margin-top: 8px;
            padding-top: 12px;
        }
        
        .price-label {
            flex: 1;
        }
        
        .price-value {
            text-align: right;
        }
        
        .alert {
            padding: 16px;
            border-radius: 12px;
            margin: 20px 0;
            color: var(--base-content);
            display: flex;
            align-items: center;
        }
        
        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 4px solid var(--info);
        }
        
        .icon {
            margin-right: 12px;
            width: 24px;
            height: 24px;
            text-align: center;
        }
        
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: var(--neutral);
            border-top: 1px solid var(--base-300);
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">HÔTEL BKBG</div>
            <p>Votre séjour de luxe</p>
        </div>
        
        <h1>Confirmation de réservation</h1>
        
        <div class="badge badge-lg badge-center">
            Référence: #{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}
        </div>
        
        <div class="card">
            <div class="card-header">
                Détails du séjour
            </div>
            <div class="card-body">
                <div class="detail-grid">
                    <div class="detail-row">
                        <div class="detail-label">Date d'arrivée:</div>
                        <div class="detail-value">{{ $reservation->check_in_date->format('d/m/Y') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Date de départ:</div>
                        <div class="detail-value">{{ $reservation->check_out_date->format('d/m/Y') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Durée du séjour:</div>
                        <div class="detail-value">{{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s)</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Nombre de personnes:</div>
                        <div class="detail-value">{{ $reservation->guests }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Type de chambre:</div>
                        <div class="detail-value">{{ $reservation->roomCategory->name }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                Informations personnelles
            </div>
            <div class="card-body">
                <div class="detail-grid">
                    <div class="detail-row">
                        <div class="detail-label">Nom:</div>
                        <div class="detail-value">{{ $reservation->title }} {{ $reservation->first_name }} {{ $reservation->last_name }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $reservation->email }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Téléphone:</div>
                        <div class="detail-value">{{ $reservation->phone }}</div>
                    </div>
                    @if($reservation->address)
                    <div class="detail-row">
                        <div class="detail-label">Adresse:</div>
                        <div class="detail-value">{{ $reservation->address }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                Récapitulatif des prix
            </div>
            <div class="card-body">
                <div class="price-rows">
                    <div class="price-row">
                        <div class="price-label">{{ $reservation->roomCategory->name }} ({{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} nuit(s))</div>
                        <div class="price-value">{{ number_format($reservation->roomCategory->price * $reservation->check_in_date->diffInDays($reservation->check_out_date), 0, ',', ' ') }} FCFA</div>
                    </div>
                    
                    @if($reservation->breakfast)
                    <div class="price-row">
                        <div class="price-label">Petit-déjeuner</div>
                        <div class="price-value">5 000 FCFA</div>
                    </div>
                    @endif
                    
                    @if($reservation->pets)
                    <div class="price-row">
                        <div class="price-label">Animaux</div>
                        <div class="price-value">5 000 FCFA</div>
                    </div>
                    @endif
                    
                    @if($reservation->airport_transfer)
                    <div class="price-row">
                        <div class="price-label">Transfert aéroport</div>
                        <div class="price-value">10 000 FCFA</div>
                    </div>
                    @endif
                    
                    <div class="price-row">
                        <div class="price-label">Taxe de séjour</div>
                        <div class="price-value">1 000 FCFA</div>
                    </div>
                    
                    <div class="price-row total">
                        <div class="price-label">Prix total</div>
                        <div class="price-value">{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info">
            <div class="icon">ℹ️</div>
            <div>
                Pour toute question ou modification concernant votre réservation, n'hésitez pas à nous contacter au +123 456 789 ou à reception@bkbghotel.com
            </div>
        </div>

        <div class="footer">
            <p>Merci d'avoir choisi l'Hôtel BKBG. Nous nous réjouissons de vous accueillir bientôt!</p>
            <p>Document généré le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</body>
</html>