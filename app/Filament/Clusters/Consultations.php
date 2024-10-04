<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Consultations extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Заявки';

    protected static ?string $clusterBreadcrumb = 'Заявки';
}
