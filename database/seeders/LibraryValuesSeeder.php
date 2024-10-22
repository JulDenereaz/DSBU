<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibraryValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('library_sources')->insert([
            ['value' => 'GENOMIC'],
            ['value' => 'TRANSCRIPTOMIC'],
            ['value' => 'METAGENOMIC'],
            ['value' => 'METATRANSCRIPTOMIC'],
            ['value' => 'SYNTHETIC'],
            ['value' => 'VIRAL RNA'],
            ['value' => 'NON GENOMIC'],
            ['value' => 'OTHER'],
        ]);

        DB::table('library_layouts')->insert([
            ['value' => 'SINGLE'],
            ['value' => 'PAIRED']
        ]);

        DB::table('library_selections')->insert([
            ['value' => '5-methylcytidine antibody'],
            ['value' => 'CAGE'],
            ['value' => 'cDNA'],
            ['value' => 'CF-H'],
            ['value' => 'CF-M'],
            ['value' => 'CF-S'],
            ['value' => 'CF-T'],
            ['value' => 'ChIP'],
            ['value' => 'DNAse'],
            ['value' => 'HMPR'],
            ['value' => 'Hybrid Selection'],
            ['value' => 'Inverse rRNA selection'],
            ['value' => 'MBD2 protein methyl-CpG binding domain'],
            ['value' => 'MDA'],
            ['value' => 'MF'],
            ['value' => 'MNase'],
            ['value' => 'MSLL'],
            ['value' => 'Oligo-dT'],
            ['value' => 'other'],
            ['value' => 'padlock probes capture method'],
            ['value' => 'PCR'],
            ['value' => 'PolyA'],
            ['value' => 'RACE'],
            ['value' => 'RANDOM'],
            ['value' => 'RANDOM PCR'],
            ['value' => 'Reduced Representation'],
            ['value' => 'Restriction Digest'],
            ['value' => 'RT-PCR'],
            ['value' => 'repeat fractionation'],
            ['value' => 'size fractionation'],
            ['value' => 'other'],
            ['value' => 'unspecified']

        ]);

        DB::table('library_strategies')->insert([
            ['value' => 'AMPLICON'],
            ['value' => 'ATAC-seq'],
            ['value' => 'Bisulfite-Seq'],
            ['value' => 'ChIP-Seq'],
            ['value' => 'ChM-Seq'],
            ['value' => 'CLONE'],
            ['value' => 'CLONEEND'],
            ['value' => 'CTS'],
            ['value' => 'DNase-Hypersensitivity'],
            ['value' => 'EST'],
            ['value' => 'FAIRE-seq'],
            ['value' => 'FINISHING'],
            ['value' => 'FL-cDNA'],
            ['value' => 'GBS'],
            ['value' => 'Hi-C'],
            ['value' => 'MBD-Seq'],
            ['value' => 'MeDIP-Seq'],
            ['value' => 'miRNA-Seq'],
            ['value' => 'MNase-Seq'],
            ['value' => 'MRE-Seq'],
            ['value' => 'ncRNA-Seq'],
            ['value' => 'OTHER'],
            ['value' => 'POOLCLONE'],
            ['value' => 'RAD-Seq'],
            ['value' => 'RIP-Seq'],
            ['value' => 'Ribo-Seq'],
            ['value' => 'RNA-Seq'],
            ['value' => 'snRNA-Seq'],
            ['value' => 'ssRNA-Seq'],
            ['value' => 'Synthetic-Long-Read'],
            ['value' => 'SELEX'],
            ['value' => 'Targeted-Capture'],
            ['value' => 'Tethered Chromating Conformation Capture'],
            ['value' => 'Tn-Seq'],
            ['value' => 'WCS'],
            ['value' => 'WGA'],
            ['value' => 'WGS'],
            ['value' => 'WXS'],
            ['value' => 'OTHER']

        ]);
    }
}
