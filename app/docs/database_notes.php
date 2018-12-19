//////////////////////////////////////////////////////////////////
mysql> DESCRIBE IDX;
+--------------------------+---------------+------+-----+---------------------+-------+
  Field                      Type            Null   Key   Default               Extra  
+--------------------------+---------------+------+-----+---------------------+-------+
  IDX_INDEX_ID               VARCHAR(10)     NO                                        
  IDX_DATE_TIME              DATETIME        NO           0000-00-00 00:00:00          
  IDX_CAPITAL_VALUE          DECIMAL(18,5)   NO           0.00000                      
  IDX_DEVIATION              DECIMAL(18,5)   NO           0.00000                      
  LDX_PERCENTAGE_DEVIATION   DECIMAL(18,5)   NO           0.00000                      
+--------------------------+---------------+------+-----+---------------------+-------+
5 rows in set (0.19 sec)

  DS30           2013-12-15 13:55:07          1489.86992        -0.48259                   -0.03238  
  DS30           2013-12-15 14:00:07          1488.91897        -1.43354                   -0.09619  
  DS30           2013-12-15 14:05:08          1487.94255        -2.40996                   -0.16170  
  DS30           2013-12-15 14:10:08          1486.32863        -4.02388                   -0.27000  
  DS30           2013-12-15 14:15:08          1485.41783        -4.93468                   -0.33111  
  DS30           2013-12-15 14:20:08          1485.51207        -4.84044                   -0.32478  
  DS30           2013-12-15 14:25:08          1486.06786        -4.28465                   -0.28749  
  DS30           2013-12-15 14:30:08          1488.96084        -1.39167                   -0.09338  
  DS30           2013-12-15 14:35:06          1485.45627        -4.89624                   -0.32853  
  DSEX           2013-12-15 09:30:06          4299.58425         0.00000                    0.00000  
  DSEX           2013-12-15 10:35:06          4296.63208        -2.95217                   -0.06866  
  DSEX           2013-12-15 10:40:07          4302.52658         2.94233                    0.06843  
  DSEX           2013-12-15 10:45:06          4303.67888         4.09463                    0.09523  
  DSEX           2013-12-15 10:50:07          4305.04786         5.46361                    0.12707  
  DSEX           2013-12-15 10:55:07          4296.67978        -2.90447                   -0.06755  
  DSEX           2013-12-15 11:00:07          4295.03743        -4.54682                   -0.10575  
  DSEX           2013-12-15 11:05:07          4295.48963        -4.09462                   -0.09523  
  DSEX           2013-12-15 11:10:07          4296.70287        -2.88138                   -0.06702  


mysql> DESCRIBE TRD;
+------------------+---------------+------+-----+---------------------+-------+
  Field              Type            Null   Key   Default               Extra  
+------------------+---------------+------+-----+---------------------+-------+
  TRD_SNO            int(30)         NO     PRI   0                            
  TRD_TOTAL_TRADES   int(30)         NO           0                            
  TRD_TOTAL_VOLUME   int(30)         NO           0                            
  TRD_TOTAL_VALUE    decimal(18,4)   NO           0.0000                       
  TRD_LM_DATE_TIME   char(30)        NO           0000-00-00 00:00:00          
+------------------+---------------+------+-----+---------------------+-------+
5 rows in set (0.18 sec)
+---------+------------------+------------------+-----------------+----------------------------+
  TRD_SNO   TRD_TOTAL_TRADES   TRD_TOTAL_VOLUME   TRD_TOTAL_VALUE   TRD_LM_DATE_TIME            
+---------+------------------+------------------+-----------------+----------------------------+
        1             118362          121994937         4976.0110   Dec 15 2013 04:21:07:370PM  
+---------+------------------+------------------+-----------------+----------------------------+
1 row in set (0.18 sec)




mysql> DESCRIBE MKISTAT8;
ERROR 1142 (42000): SELECT command denied to user 'stockbangladesh'@'5.9.77.130' for table 'MKISTAT8'
                                                                                     mysql> DESCRIBE MKISTAT;
+--------------------------------+---------------+------+-----+---------+-------+
  Field                            Type            Null   Key   Default   Extra  
+--------------------------------+---------------+------+-----+---------+-------+
  MKISTAT_INSTRUMENT_CODE          VARCHAR(10)     NO     PRI   NULL             
  MKISTAT_INSTRUMENT_NUMBER        INT(20)         NO           NULL             
  MKISTAT_QUOTE_BASES              VARCHAR(10)     NO                            
  mkistat_open_price               decimal(9,2)    no           0.00             
  mkistat_pub_last_traded_price    decimal(9,2)    no           0.00             
  mkistat_spot_last_traded_price   decimal(9,2)    no           null             
  mkistat_high_price               decimal(9,2)    no           0.00             
  mkistat_low_price                decimal(9,2)    no           0.00             
  mkistat_close_price              decimal(9,2)    no           0.00             
  mkistat_yday_close_price         decimal(9,2)    no     mul   0.00             
  mkistat_total_trades             int(30)         no           0                
  mkistat_total_volume             int(30)         no           0                
  mkistat_total_value              decimal(18,4)   no           0.0000           
  mkistat_public_total_trades      int(6)          no           null             
  mkistat_public_total_volume      int(6)          no           null             
  mkistat_public_total_value       decimal(18,4)   no           null             
  mkistat_spot_total_trades        int(6)          no           null             
  mkistat_spot_total_volume        int(6)          no           null             
  mkistat_spot_total_value         decimal(18,4)   no           null             
  mkistat_lm_date_time             varchar(50)     no           null             
+--------------------------------+---------------+------+-----+---------+-------+
20 rows in set (0.18 sec)

  MKISTAT_INSTRUMENT_CODE   MKISTAT_INSTRUMENT_NUMBER   MKISTAT_QUOTE_BASES   MKISTAT_OPEN_PRICE   MKISTAT_PUB_LAST_TRADED_PRICE   MKISTAT_SPOT_LAST_TRADED_PRICE   MKISTAT_HIGH_PRICE   MKISTAT_LOW_PRICE   MKISTAT_CLOSE_PRICE   MKISTAT_YDAY_CLOSE_PRICE   MKISTAT_TOTAL_TRADES   MKISTAT_TOTAL_VOLUME   MKISTAT_TOTAL_VALUE   MKISTAT_PUBLIC_TOTAL_TRADES   MKISTAT_PUBLIC_TOTAL_VOLUME   MKISTAT_PUBLIC_TOTAL_VALUE   MKISTAT_SPOT_TOTAL_TRADES   MKISTAT_SPOT_TOTAL_VOLUME   MKISTAT_SPOT_TOTAL_VALUE   MKISTAT_LM_DATE_TIME
+-------------------------+---------------------------+---------------------+--------------------+-------------------------------+--------------------------------+--------------------+-------------------+---------------------+--------------------------+----------------------+----------------------+---------------------+-----------------------------+-----------------------------+----------------------------+---------------------------+---------------------------+--------------------------+----------------------------+
  1JANATAMF                                         1   A-MF                                6.20                            6.10                             0.00                 6.30                6.10                  6.10                       6.10                     58                 191000                1.1688                            58                        191000                       1.1688                           0                           0                     0.0000   Dec 15 2013 02:30:27:357PM
  1STICB                                            3   A-MF                              841.00                            0.00                             0.00                 0.00                0.00                841.00                     841.00                      0                      0                0.0000                             0                             0                       0.0000                           0                           0                     0.0000   Dec 15 2013 02:30:22:027PM
  1STPRIMFMF                                        4   A-MF                               25.00                           26.30                             0.00                26.90               24.60                 26.50                      24.60                   1011                1557000               40.7801                          1011                       1557000                      40.7801                           0                           0                     0.0000   Dec 15 2013 02:30:08:433PM
  2NDICB                                            5   A-MF                              250.10                            0.00                             0.00                 0.00                0.00                250.10                     250.10                      0                      0                0.0000                             0                             0                       0.0000                           0                           0                     0.0000   Dec 15 2013 02:30:22:043PM
  3RDICB                                            6   A-MF                              200.00                            0.00                             0.00                 0.00                0.00                200.00                     200.00                      0                      0                0.0000                             0                             0                       0.0000                           0                           0                     0.0000   Dec 15 2013 02:30:08:450PM
  4THICB                                            7   A-MF                              190.00                            0.00                             0.00                 0.00                0.00                190.00                     190.00                      0                      0                0.0000                             0                             0                       0.0000                           0                           0                     0.0000   Dec 15 2013 02:30:08:450PM
  5THICB                                            8   A-MF                              148.00                          150.00                             0.00               150.00              148.00                148.80                     150.00                      4                   1000                0.1488                             4                          1000                       0.1488                           0                           0                     0.0000   Dec 15 2013 02:30:04:823PM
  6THICB                                            9   A-MF                               53.20                           52.80                             0.00                53.50               52.80                 53.00                      53.00                     22                   4200                0.2229                            22                          4200                       0.2229                           0                           0                     0.0000   Dec 15 2013 02:30:04:840PM
  7THICB                                           10   A-MF                               86.80                            0.00                             0.00                 0.00                0.00                 86.80                      86.80                      0                      0                0.0000                             0                             0                       0.0000                           0                           0                     0.0000   Dec 15 2013 02:30:23:357PM
  8THICB                                           11   A-MF                               52.90                           52.90                             0.00                53.00               52.90                 52.90                      52.90                      7                   4500                0.2381                             7                          4500                       0.2381                           0                           0                     0.0000   Dec 15 2013 02:30:23:370PM
+-------------------------+---------------------------+---------------------+--------------------+-------------------------------+--------------------------------+--------------------+-------------------+---------------------+--------------------------+----------------------+----------------------+---------------------+-----------------------------+-----------------------------+----------------------------+---------------------------+---------------------------+--------------------------+----------------------------+

mysql> SELECT MKISTAT_INSTRUMENT_CODE,MKISTAT_INSTRUMENT_NUMBER,MKISTAT_QUOTE_BASES FROM MKISTAT ORDER BY MKISTAT_INSTRUMENT_NUMBER ASC;
+-------------------------+---------------------------+---------------------+
  MKISTAT_INSTRUMENT_CODE   MKISTAT_INSTRUMENT_NUMBER   MKISTAT_QUOTE_BASES
+-------------------------+---------------------------+---------------------+
  1JANATAMF                                         1   A-MF
  PTL                                               2   N-EQ
  1STICB                                            3   A-MF
  1STPRIMFMF                                        4   A-MF
  2NDICB                                            5   A-MF
  3RDICB                                            6   A-MF
  4THICB                                            7   A-MF
  5THICB                                            8   A-MF
  6THICB                                            9   A-MF
  7THICB                                           10   A-MF
  8THICB                                           11   A-MF
  ABBANK                                           12   A-EQ
  ACI                                              13   A-EQ
  ACIFORMULA                                       14   A-EQ
  ACIZCBOND                                        15   A-CB
  ACTIVEFINE                                       16   A-EQ
  AFTABAUTO                                        17   A-EQ
  AGNISYSL                                         18   A-EQ
  AGRANINS                                         19   A-EQ
  AIBL1STIMF                                       20   A-MF
  AIMS1STMF                                        21   A-MF
  ALARABANK                                        22   A-EQ
  AL-HAJTEX                                        23   A-EQ
  ALLTEX                                           24   Z-EQ
  AMBEEPHA                                         25   A-EQ
  AMCL(PRAN)                                       26   A-EQ
  ANLIMAYARN                                       27   A-EQ
  ANWARGALV                                        28   B-EQ
  APEXADELFT                                       29   A-EQ
  APEXFOODS                                        30   A-EQ
  APEXSPINN                                        31   A-EQ
  BEACHHATCH                                       32   A-EQ
  BEACONPHAR                                       33   Z-EQ
  BEDL                                             34   A-EQ
  BERGERPBL                                        35   A-EQ
  BEXIMCO                                          36   A-EQ
  DEBARACEM                                        37   A-DE
  BGIC                                             38   A-EQ
  BIFC                                             39   B-EQ
  APEXTANRY                                        40   A-EQ
  ARAMIT                                           41   A-EQ
  ARAMITCEM                                        42   A-EQ
  ASIAINS                                          43   A-EQ
  ASIAPACINS                                       44   A-EQ
  ATLASBANG                                        45   A-EQ
  AZIZPIPES                                        46   Z-EQ
  BANGAS                                           47   A-EQ
  BANKASIA                                         48   A-EQ
  LINDEBD                                          49   A-EQ
  BRACBANK                                         50   A-EQ
  BRACSCBOND                                       51   A-CB
  BSC                                              52   A-EQ
  BSRMSTEEL                                        53   A-EQ
  BXPHARMA                                         54   A-EQ
  BXSYNTH                                          55   A-EQ
  CENTRALINS                                       56   A-EQ
  CITYBANK                                         57   A-EQ
  CITYGENINS                                       58   A-EQ
  CMCKAMAL                                         59   A-EQ
  CONFIDCEM                                        60   A-EQ
  BATASHOE                                         61   A-EQ
  BATBC                                            62   A-EQ
  BAYLEASING                                       63   A-EQ
  BDAUTOCA                                         64   B-EQ
  BDCOM                                            65   A-EQ
  BDFINANCE                                        66   A-EQ
  BDLAMPS                                          67   A-EQ
  BDSERVICE                                        68   A-EQ
  BDTHAI                                           69   B-EQ
  BDWELDING                                        70   B-EQ
  CONTININS                                        71   A-EQ
  CVOPRL                                           72   A-EQ
  DACCADYE                                         73   A-EQ
  DAFODILCOM                                       74   A-EQ
  DBH                                              75   A-EQ
  DBH1STMF                                         76   A-MF
  DELTALIFE                                        77   A-EQ
  DELTASPINN                                       78   A-EQ
  DESCO                                            79   A-EQ
  DESHBANDHU                                       80   A-EQ
  DHAKABANK                                        81   A-EQ
  DHAKAINS                                         82   A-EQ
  DSHGARME                                         83   B-EQ
  DULAMIACOT                                       84   Z-EQ
  DUTCHBANGL                                       85   A-EQ
  EASTERNINS                                       86   A-EQ
  EASTLAND                                         87   A-EQ
  EASTRNLUB                                        88   A-EQ
  EBL                                              89   A-EQ
  EBL1STMF                                         90   A-MF
  EBLNRBMF                                         91   A-MF
  ECABLES                                          92   Z-EQ
  EHL                                              93   A-EQ
  EXIMBANK                                         94   A-EQ
  FAREASTLIF                                       95   A-EQ
  FASFIN                                           96   B-EQ
  FEDERALINS                                       97   A-EQ
  FINEFOODS                                        98   A-EQ
  FIRSTSBANK                                       99   A-EQ
  FLEASEINT                                       100   A-EQ
  FUWANGFOOD                                      101   A-EQ
  GEMINISEA                                       102   A-EQ
  GLAXOSMITH                                      103   A-EQ
  GLOBALINS                                       104   A-EQ
  GOLDENSON                                       105   A-EQ
  GP                                              106   A-EQ
  GQBALLPEN                                       107   A-EQ
  GRAMEEN1                                        108   A-MF
  GRAMEENS2                                       109   A-MF
  GREENDELMF                                      110   A-MF
  GREENDELT                                       111   A-EQ
  HAKKANIPUL                                      112   B-EQ
  HEIDELBCEM                                      113   A-EQ
  HRTEX                                           114   A-EQ
  IBBLPBOND                                       115   A-CB
  IBNSINA                                         116   A-EQ
  ICB                                             117   A-EQ
  ICB1STNRB                                       118   A-MF
  ICB2NDNRB                                       119   A-MF
  ICB3RDNRB                                       120   A-MF
  BDBUILDING                                      121   N-EQ
  LIBRAINFU                                       122   A-EQ
  MAKSONSPIN                                      123   B-EQ
  MALEKSPIN                                       124   A-EQ
  MARICO                                          125   A-EQ
  MBL1STMF                                        126   A-MF
  MEGCONMILK                                      127   Z-EQ
  MEGHNACEM                                       128   A-EQ
  MEGHNALIFE                                      129   A-EQ
  MEGHNAPET                                       130   Z-EQ
  MERCANBANK                                      131   A-EQ
  MERCINS                                         132   A-EQ
  METROSPIN                                       133   A-EQ
  MICEMENT                                        134   A-EQ
  MIDASFIN                                        135   Z-EQ
  MIRACLEIND                                      136   B-EQ
  MITHUNKNIT                                      137   A-EQ
  MODERNDYE                                       138   B-EQ
  MONNOCERA                                       139   B-EQ
  RDFOOD                                          140   A-EQ
  MONNOSTAF                                       141   A-EQ
  MPETROLEUM                                      142   A-EQ
  MTBL                                            143   A-EQ
  NATLIFEINS                                      144   A-EQ
  NAVANACNG                                       145   A-EQ
  NBL                                             146   B-EQ
  ICBAMCL2ND                                      147   A-MF
  ICBEPMF1S1                                      148   A-MF
  ICBIBANK                                        149   Z-EQ
  ICBISLAMIC                                      150   A-MF
  IDLC                                            151   A-EQ
  IFIC                                            152   A-EQ
  IFIC1STMF                                       153   A-MF
  IFILISLMF1                                      154   A-MF
  ILFSL                                           155   B-EQ
  IMAMBUTTON                                      156   Z-EQ
  INTECH                                          157   A-EQ
  IPDC                                            158   A-EQ
  ISLAMIBANK                                      159   A-EQ
  ISLAMICFIN                                      160   A-EQ
  ISLAMIINS                                       161   A-EQ
  ISNLTD                                          162   B-EQ
  JAMUNABANK                                      163   A-EQ
  JAMUNAOIL                                       164   A-EQ
  JANATAINS                                       165   A-EQ
  JUTESPINN                                       166   Z-EQ
  KARNAPHULI                                      167   A-EQ
  KAY&QUE                                         168   Z-EQ
  KEYACOSMET                                      169   A-EQ
  KOHINOOR                                        170   A-EQ
  KPCL                                            171   A-EQ
  LAFSURCEML                                      172   Z-EQ
  LANKABAFIN                                      173   A-EQ
  LEGACYFOOT                                      174   B-EQ
  NCCBANK                                         175   A-EQ
  NHFIL                                           176   B-EQ
  NITOLINS                                        177   A-EQ
  NORTHERN                                        178   Z-EQ
  PRAGATIINS                                      179   A-EQ
  PRAGATILIF                                      180   A-EQ
  PREMIERBAN                                      181   A-EQ
  PREMIERLEA                                      182   Z-EQ
  PRIME1ICBA                                      183   A-MF
  PRIMEBANK                                       184   A-EQ
  PRIMEFIN                                        185   A-EQ
  PRIMEINSUR                                      186   A-EQ
  PRIMELIFE                                       187   A-EQ
  PRIMETEX                                        188   A-EQ
  PROGRESLIF                                      189   A-EQ
  NORTHRNINS                                      190   A-EQ
  NPOLYMAR                                        191   A-EQ
  NTC                                             192   A-EQ
  NTLTUBES                                        193   A-EQ
  SUNLIFEINS                                      194   B-EQ
  OLYMPIC                                         195   A-EQ
  ONEBANKLTD                                      196   A-EQ
  ORIONINFU                                       197   A-EQ
  PADMAOIL                                        198   A-EQ
  PARAMOUNT                                       199   A-EQ
  PEOPLESINS                                      200   A-EQ
  PF1STMF                                         201   A-MF
  PHARMAID                                        202   A-EQ
  PHENIXINS                                       203   A-EQ
  PHOENIXFIN                                      204   A-EQ
  PHPMF1                                          205   A-MF
  PIONEERINS                                      206   A-EQ
  PLFSL                                           207   A-EQ
  POPULAR1MF                                      208   A-MF
  POPULARLIF                                      209   A-EQ
  POWERGRID                                       210   A-EQ
  PROVATIINS                                      211   A-EQ
  PUBALIBANK                                      212   A-EQ
  PURABIGEN                                       213   A-EQ
  QSMDRYCELL                                      214   A-EQ
  RAHIMAFOOD                                      215   A-EQ
  RAHIMTEXT                                       216   A-EQ
  RAKCERAMIC                                      217   A-EQ
  RANFOUNDRY                                      218   A-EQ
  RECKITTBEN                                      219   A-EQ
  RELIANCINS                                      220   A-EQ
  RENATA                                          221   A-EQ
  RENWICKJA                                       222   A-EQ
  REPUBLIC                                        223   A-EQ
  RNSPIN                                          224   A-EQ
  RUPALIBANK                                      225   A-EQ
  RUPALIINS                                       226   A-EQ
  RUPALILIFE                                      227   A-EQ
  ZEALBANGLA                                      228   Z-EQ
  UTTARAFIN                                       229   A-EQ
  UTTARABANK                                      230   A-EQ
  USMANIAGL                                       231   A-EQ
  UNITEDINS                                       232   A-EQ
  UNITEDAIR                                       233   A-EQ
  UNIONCAP                                        234   B-EQ
  ULC                                             235   A-EQ
  UCBL                                            236   A-EQ
  TRUSTBANK                                       237   A-EQ
  TRUSTB1MF                                       238   A-MF
  TITASGAS                                        239   A-EQ
  TALLUSPIN                                       240   A-EQ
  TAKAFULINS                                      241   A-EQ
  SAFKOSPINN                                      242   A-EQ
  SUMITPOWER                                      243   A-EQ
  SAIHAMTEX                                       244   A-EQ
  STYLECRAFT                                      245   A-EQ
  STANDBANKL                                      246   A-EQ
  SALAMCRST                                       247   A-EQ
  STANDARINS                                      248   A-EQ
  STANCERAM                                       249   A-EQ
  SALVOCHEM                                       250   B-EQ
  SAMATALETH                                      251   Z-EQ
  SQURPHARMA                                      252   A-EQ
  SQUARETEXT                                      253   A-EQ
  FUWANGCER                                       254   A-EQ
  SAMORITA                                        255   A-EQ
  SANDHANINS                                      256   A-EQ
  SAPORTL                                         257   A-EQ
  SAVAREFR                                        258   Z-EQ
  SEBL1STMF                                       259   A-MF
  SHAHJABANK                                      260   A-EQ
  SHYAMPSUG                                       261   Z-EQ
  SIBL                                            262   A-EQ
  SPCERAMICS                                      263   A-EQ
  SINGERBD                                        264   A-EQ
  SOUTHEASTB                                      265   A-EQ
  SONARGAON                                       266   B-EQ
  SINOBANGLA                                      267   A-EQ
  SONARBAINS                                      268   A-EQ
  SONALIANSH                                      269   A-EQ
  T05Y0715                                        270   A-TB
  T05Y0815                                        271   A-TB
  T10Y0117                                        272   A-TB
  T10Y0118                                        273   A-TB
  T10Y0119                                        274   A-TB
  T10Y0121                                        275   A-TB
  T10Y0214                                        276   A-TB
  T10Y0215                                        277   A-TB
  T10Y0216                                        278   A-TB
  T10Y0217                                        279   A-TB
  T10Y0218                                        280   A-TB
  T10Y0219                                        281   A-TB
  T10Y0220                                        282   A-TB
  T10Y0221                                        283   A-TB
  T10Y0317                                        284   A-TB
  T10Y0318                                        285   A-TB
  T10Y0319                                        286   A-TB
  T10Y0320                                        287   A-TB
  T10Y0321                                        288   A-TB
  T10Y0414                                        289   A-TB
  T10Y0415                                        290   A-TB
  T10Y0416                                        291   A-TB
  T10Y0418                                        292   A-TB
  T10Y0419                                        293   A-TB
  T10Y0420                                        294   A-TB
  T10Y0421                                        295   A-TB
  T10Y0517                                        296   A-TB
  T10Y0518                                        297   A-TB
  T10Y0519                                        298   A-TB
  T10Y0520                                        299   A-TB
  T10Y0614                                        300   A-TB
  T10Y0615                                        301   A-TB
  T10Y0616                                        302   A-TB
  T10Y0617                                        303   A-TB
  T10Y0618                                        304   A-TB
  T10Y0619                                        305   A-TB
  T10Y0620                                        306   A-TB
  T10Y0717                                        307   A-TB
  T10Y0718                                        308   A-TB
  T10Y0719                                        309   A-TB
  T10Y0720                                        310   A-TB
  T10Y0814                                        311   A-TB
  T10Y0816                                        312   A-TB
  T10Y0817                                        313   A-TB
  T10Y0818                                        314   A-TB
  T10Y0819                                        315   A-TB
  T10Y0820                                        316   A-TB
  T10Y0916                                        317   A-TB
  T10Y0917                                        318   A-TB
  T10Y0918                                        319   A-TB
  T10Y0919                                        320   A-TB
  T10Y0920                                        321   A-TB
  T10Y1014                                        322   A-TB
  T10Y1016                                        323   A-TB
  T10Y1017                                        324   A-TB
  T10Y1018                                        325   A-TB
  T10Y1019                                        326   A-TB
  T10Y1116                                        327   A-TB
  T10Y1117                                        328   A-TB
  T10Y1118                                        329   A-TB
  T10Y1120                                        330   A-TB
  T10Y1213                                        331   A-TB
  T10Y1214                                        332   A-TB
  T10Y1215                                        333   A-TB
  T10Y1216                                        334   A-TB
  T10Y1217                                        335   A-TB
  T10Y1218                                        336   A-TB
  T10Y1219                                        337   A-TB
  T10Y1220                                        338   A-TB
  T15Y0123                                        339   A-TB
  T15Y0124                                        340   A-TB
  T15Y0125                                        341   A-TB
  T15Y0223                                        342   A-TB
  T15Y0224                                        343   A-TB
  T15Y0225                                        344   A-TB
  T15Y0226                                        345   A-TB
  T15Y0323                                        346   A-TB
  T15Y0324                                        347   A-TB
  T15Y0325                                        348   A-TB
  T15Y0326                                        349   A-TB
  T15Y0423                                        350   A-TB
  T15Y0424                                        351   A-TB
  T15Y0425                                        352   A-TB
  T15Y0426                                        353   A-TB
  T15Y0523                                        354   A-TB
  T15Y0524                                        355   A-TB
  T15Y0525                                        356   A-TB
  T15Y0623                                        357   A-TB
  T15Y0624                                        358   A-TB
  T15Y0625                                        359   A-TB
  T15Y0722                                        360   A-TB
  T15Y0723                                        361   A-TB
  T15Y0724                                        362   A-TB
  T15Y0725                                        363   A-TB
  T15Y0822                                        364   A-TB
  T15Y0823                                        365   A-TB
  T15Y0824                                        366   A-TB
  T15Y0825                                        367   A-TB
  T15Y0922                                        368   A-TB
  T15Y0923                                        369   A-TB
  T15Y0924                                        370   A-TB
  T15Y0925                                        371   A-TB
  T15Y1022                                        372   A-TB
  T15Y1023                                        373   A-TB
  T15Y1024                                        374   A-TB
  T15Y1025                                        375   A-TB
  T15Y1122                                        376   A-TB
  T15Y1123                                        377   A-TB
  T15Y1125                                        378   A-TB
  T15Y1222                                        379   A-TB
  T15Y1223                                        380   A-TB
  T15Y1224                                        381   A-TB
  T15Y1225                                        382   A-TB
  T20Y0128                                        383   A-TB
  T20Y0129                                        384   A-TB
  T20Y0131                                        385   A-TB
  T20Y0228                                        386   A-TB
  T20Y0229                                        387   A-TB
  T20Y0230                                        388   A-TB
  T20Y0231                                        389   A-TB
  T20Y0328                                        390   A-TB
  T20Y0329                                        391   A-TB
  T20Y0330                                        392   A-TB
  T20Y0428                                        393   A-TB
  T20Y0429                                        394   A-TB
  T20Y0430                                        395   A-TB
  T20Y0528                                        396   A-TB
  T20Y0530                                        397   A-TB
  T20Y0628                                        398   A-TB
  T20Y0629                                        399   A-TB
  T20Y0630                                        400   A-TB
  T20Y0727                                        401   A-TB
  T20Y0728                                        402   A-TB
  T20Y0729                                        403   A-TB
  T20Y0730                                        404   A-TB
  T20Y0827                                        405   A-TB
  T20Y0828                                        406   A-TB
  T20Y0829                                        407   A-TB
  T20Y0830                                        408   A-TB
  T20Y0927                                        409   A-TB
  T20Y0928                                        410   A-TB
  T20Y0930                                        411   A-TB
  T20Y1027                                        412   A-TB
  T20Y1028                                        413   A-TB
  T20Y1029                                        414   A-TB
  T20Y1030                                        415   A-TB
  T20Y1127                                        416   A-TB
  T20Y1128                                        417   A-TB
  T20Y1130                                        418   A-TB
  T20Y1227                                        419   A-TB
  T20Y1228                                        420   A-TB
  T20Y1229                                        421   A-TB
  T20Y1230                                        422   A-TB
  T5Y0112                                         423   A-TB
  T5Y0113                                         424   A-TB
  T5Y0114                                         425   A-TB
  T5Y0115                                         426   A-TB
  T5Y0116                                         427   A-TB
  T5Y0212                                         428   A-TB
  T5Y0213                                         429   A-TB
  T5Y0214                                         430   A-TB
  T5Y0215                                         431   A-TB
  T5Y0216                                         432   A-TB
  T5Y0313                                         433   A-TB
  T5Y0314                                         434   A-TB
  T5Y0315                                         435   A-TB
  T5Y0316                                         436   A-TB
  T5Y0412                                         437   A-TB
  T5Y0414                                         438   A-TB
  T5Y0415                                         439   A-TB
  T5Y0514                                         440   A-TB
  T10Y0721                                        441   A-TB
  T5Y0613                                         442   A-TB
  T5Y0615                                         443   A-TB
  T5Y0712                                         444   A-TB
  T5Y0713                                         445   A-TB
  T5Y0714                                         446   A-TB
  T5Y0811                                         447   A-TB
  T5Y0812                                         448   A-TB
  T5Y0813                                         449   A-TB
  T5Y0814                                         450   A-TB
  T5Y0911                                         451   A-TB
  T5Y0912                                         452   A-TB
  T5Y0913                                         453   A-TB
  T5Y0914                                         454   A-TB
  T5Y0915                                         455   A-TB
  T5Y1011                                         456   A-TB
  T5Y1012                                         457   A-TB
  T5Y1013                                         458   A-TB
  T5Y1014                                         459   A-TB
  T5Y1015                                         460   A-TB
  T5Y1111                                         461   A-TB
  T5Y1112                                         462   A-TB
  T5Y1113                                         463   A-TB
  T5Y1114                                         464   A-TB
  T5Y1115                                         465   A-TB
  T20Y0531                                        466   A-TB
  LRGLOBMF1                                       467   A-MF
  T5Y1211                                         468   A-TB
  T5Y1212                                         469   A-TB
  T5Y1213                                         470   A-TB
  T5Y1214                                         471   A-TB
  T5Y1215                                         472   A-TB
  RELIANCE1                                       473   A-MF
  MJLBD                                           474   A-EQ
  T5Y0416                                         475   A-TB
  T5Y0516                                         476   A-TB
  T10Y0521                                        477   A-TB
  T10Y0621                                        478   A-TB
  T15Y0526                                        479   A-TB
  T20Y0431                                        480   A-TB
  T15Y0626                                        481   A-TB
  DEBBDLUGG                                       482   A-DE
  DEBBDWELD                                       483   A-DE
  DEBBDZIPP                                       484   A-DE
  DEBBXDENIM                                      485   A-DE
  DEBBXFISH                                       486   A-DE
  DEBBXKNI                                        487   A-DE
  DEBBXTEX                                        488   A-DE
  T5Y0616                                         489   A-TB
  T5Y0716                                         490   A-TB
  T5Y0816                                         491   A-TB
  T10Y0821                                        492   A-TB
  T20Y0631                                        493   A-TB
  T20Y0731                                        494   A-TB
  T15Y0826                                        495   A-TB
  T15Y0926                                        496   A-TB
  T20Y0831                                        497   A-TB
  T20Y0931                                        498   A-TB
  T10Y0921                                        499   A-TB
  T5Y0916                                         500   A-TB
  ZAHINTEX                                        501   A-EQ
  ABB1STMF                                        502   A-MF
  NLI1STMF                                        503   A-MF
  FBFIF                                           504   A-MF
  GSPFINANCE                                      505   A-EQ
  GPHISPAT                                        506   A-EQ
  PADMALIFE                                       507   B-EQ
  NCCBLMF1                                        508   A-MF
  GBBPOWER                                        509   A-EQ
  BSCCL                                           510   A-EQ
  SAIHAMCOT                                       511   A-EQ
  UNIQUEHRL                                       512   A-EQ
  AAMRATECH                                       513   A-EQ
  GENNEXT                                         514   A-EQ
  ENVOYTEX                                        515   A-EQ
  SPPCL                                           516   A-EQ
  ARGONDENIM                                      517   A-EQ
  PREMIERCEM                                      518   N-EQ
  GHAIL                                           519   A-EQ
  GHCL                                            520   A-EQ
  ORIONPHARM                                      521   A-EQ
  BENGALWTL                                       522   N-EQ
  ICBSONALI1                                      523   A-MF
  FAMILYTEX                                       524   Z-EQ
  JMISMDL                                         525   A-EQ
  EXIM1STMF                                       526   A-MF
  CENTRALPHL                                      527   A-EQ
  FAREASTFIN                                      528   N-EQ
+-------------------------+---------------------------+---------------------+
528 rows in set (0.34 sec)





mysql> DESCRIBE MAN;
+----------------------------+-------------+------+-----+---------------------+-------+
  Field                        Type          Null   Key   Default               Extra  
+----------------------------+-------------+------+-----+---------------------+-------+
  MAN_ANNOUNCEMENT_DATE_TIME   datetime      NO           0000-00-00 00:00:00          
  MAN_ANNOUNCEMENT_PREFIX      varchar(12)   NO           NULL                         
  MAN_ANNOUNCEMENT             text          NO           NULL                         
  MAN_EXPIRY_DATE              date          NO           0000-00-00                   
+----------------------------+-------------+------+-----+---------------------+-------+
4 rows in set (0.19 sec)

                                                                                                                                                                             2013-12-15       
  2013-12-15 11:21:16          ABB1STMF                  On the close of operation on December 12, 2013, the Fund has reported Net Asset Value (NAV) of Tk. 11.19 per unit on the basis of current market price and Tk. 10.80 per unit on the basis of cost price against face value of Tk. 10.00 whereas total Net Assets of the Fund stood at Tk. 1,818,968,368.45 on the basis of market price and Tk. 1,756,354,871.72 on the basis of cost price after considering all assets and liabilities of the Fund.                                                                                                                                                                                                                                                                                                                                                          2013-12-15       
  2013-12-15 11:23:58          AIMS1STMF                 On the close of operation on December 12, 2013, the Fund has reported Net Asset Value (NAV) of Tk. 48.00 per unit at current market price basis and Tk. 15.80 per unit at cost price basis against face value of Tk. 10.00 whereas Net Assets of the Fund stood at Tk. 1,989,607,996.00.



SELECT 0 AS `market_id`,12 AS `instrument_id`,`open`,`high`,`low`,`close`,`volume`,`trade`,`tradevalues`,FROM_UNIXTIME( `daystamp` ) AS `date`  FROM `outputs` WHERE `symbol` = 11101

SELECT 13 AS `market_id`,2 AS `IDX_INDEX_ID`,`IDX_CAPITAL_VALUE`,`IDX_DEVIATION`,`IDX_PERCENTAGE_DEVIATION`,`IDX_DATE_TIME`  FROM `index` WHERE `IDX_DATE_TIME` LIKE '%2013-12-18%' AND `IDX_INDEX_ID` LIKE '%DSEX%'
INSERT INTO `index_values` (`market_id`, `INDEX_ID`, `CAPITAL_VALUE`, `DEVIATION`, `PERCENTAGE_DEVIATION`, `DATE_TIME`) VALUES


SELECT 17 AS `market_id`,`code` AS `instrument_code`,`quote_bases` AS `quote_bases`,`open` AS `open_price`,`lastprice` AS `pub_last_traded_price`,`spotlastprice` AS `spot_last_traded_price`,`high` AS `high_price`,`low` AS `low_price`,`close` AS `close_price`,`yclose` AS `yday_close_price`,`trade` AS `total_trades`,`volume` AS `total_volume`,`trade` AS `public_total_trades`,`value` AS `public_total_value`,0 AS `spot_total_trades`,0 AS `spot_total_volume`,0 AS `spot_total_value`,STR_TO_DATE(`date_time`,'%b %d %Y %h:%i:%s:%f%p') AS `lm_date_time` FROM `data_banks_intraday` WHERE `date_time` LIKE '%Dec 18 2013%'
INSERT INTO `data_banks_intradays` (`market_id`,`instrument_code`,`quote_bases`,`open_price`,`pub_last_traded_price`,`spot_last_traded_price`,`high_price`,`low_price`,`close_price`,`yday_close_price`,`total_trades`,`total_volume`,`public_total_trades`,`public_total_value`,`spot_total_trades`,`spot_total_volume`,`spot_total_value`,`lm_date_time`) VALUES



SELECT `DataBanksIntraday`.`id`, `DataBanksIntraday`.`market_id`, `DataBanksIntraday`.`instrument_id`, `DataBanksIntraday`.`instrument_code`, `DataBanksIntraday`.`quote_bases`, `DataBanksIntraday`.`open_price`, `DataBanksIntraday`.`pub_last_traded_price`, `DataBanksIntraday`.`spot_last_traded_price`, `DataBanksIntraday`.`high_price`, `DataBanksIntraday`.`low_price`, `DataBanksIntraday`.`close_price`, `DataBanksIntraday`.`yday_close_price`, `DataBanksIntraday`.`total_trades`, `DataBanksIntraday`.`total_volume`, `DataBanksIntraday`.`total_value`, `DataBanksIntraday`.`public_total_trades`, `DataBanksIntraday`.`public_total_volume`, `DataBanksIntraday`.`public_total_value`, `DataBanksIntraday`.`spot_total_trades`, `DataBanksIntraday`.`spot_total_volume`, `DataBanksIntraday`.`spot_total_value`, `DataBanksIntraday`.`lm_date_time`, (close_price-yday_close_price) AS `DataBanksIntraday__change`, ((close_price-yday_close_price)/close_price*100) AS `DataBanksIntraday__change_per` FROM `stock_sbnew`.`data_banks_intradays` AS `DataBanksIntraday` WHERE `DataBanksIntraday`.`market_id` = (17) ORDER BY `DataBanksIntraday`.`id` DESC LIMIT 500

sample database insert query string by select statment
==========================
SELECT CONCAT("INSERT INTO instruments (`id`,`instrument_code`) VALUES (",id,",'",instrument_code,"');")  FROM `data_banks_intradays` WHERE `id` = 177128

SELECT CONCAT("INSERT INTO instruments (`id`,`instrument_code`) VALUES (",MKISTAT_INSTRUMENT_NUMBER,",'",MKISTAT_INSTRUMENT_CODE,"');")  FROM `MKISTAT`

mysql> SELECT CONCAT("INSERT INTO instruments (`id`,`instrument_code`) VALUES (",MKISTAT_INSTRUMENT_NUMBER,",'",MKISTAT_INSTRUMENT_CODE,"');")  FROM `MKISTAT`;
+----------------------------------------------------------------------------------------------------------------------------------+
  CONCAT("INSERT INTO instruments (`id`,`instrument_code`) VALUES (",MKISTAT_INSTRUMENT_NUMBER,",'",MKISTAT_INSTRUMENT_CODE,"');")  
+----------------------------------------------------------------------------------------------------------------------------------+
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (1,'1JANATAMF ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (3,'1STICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (4,'1STPRIMFMF');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (5,'2NDICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (6,'3RDICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (7,'4THICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (8,'5THICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (9,'6THICB    ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (10,'7THICB    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (11,'8THICB    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (513,'AAMRATECH ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (502,'ABB1STMF  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (12,'ABBANK    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (13,'ACI       ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (14,'ACIFORMULA');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (15,'ACIZCBOND ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (16,'ACTIVEFINE');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (17,'AFTABAUTO ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (18,'AGNISYSL  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (19,'AGRANINS  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (20,'AIBL1STIMF');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (21,'AIMS1STMF ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (23,'AL-HAJTEX ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (22,'ALARABANK ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (24,'ALLTEX    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (25,'AMBEEPHA  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (26,'AMCL(PRAN)');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (27,'ANLIMAYARN');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (28,'ANWARGALV ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (29,'APEXADELFT');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (30,'APEXFOODS ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (31,'APEXSPINN ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (40,'APEXTANRY ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (529,'APOLOISPAT');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (41,'ARAMIT    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (42,'ARAMITCEM ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (517,'ARGONDENIM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (43,'ASIAINS   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (44,'ASIAPACINS');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (45,'ATLASBANG ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (46,'AZIZPIPES ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (47,'BANGAS    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (48,'BANKASIA  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (61,'BATASHOE  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (62,'BATBC     ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (63,'BAYLEASING');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (64,'BDAUTOCA  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (121,'BDBUILDING');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (65,'BDCOM     ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (66,'BDFINANCE ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (67,'BDLAMPS   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (68,'BDSERVICE ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (69,'BDTHAI    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (70,'BDWELDING ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (32,'BEACHHATCH');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (33,'BEACONPHAR');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (34,'BEDL      ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (522,'BENGALWTL ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (35,'BERGERPBL ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (36,'BEXIMCO   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (38,'BGIC      ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (39,'BIFC      ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (50,'BRACBANK  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (51,'BRACSCBOND');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (52,'BSC       ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (510,'BSCCL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (53,'BSRMSTEEL ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (54,'BXPHARMA  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (55,'BXSYNTH   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (56,'CENTRALINS');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (527,'CENTRALPHL');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (57,'CITYBANK  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (58,'CITYGENINS');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (59,'CMCKAMAL  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (60,'CONFIDCEM ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (71,'CONTININS ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (72,'CVOPRL    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (73,'DACCADYE  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (74,'DAFODILCOM');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (75,'DBH       ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (76,'DBH1STMF  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (37,'DEBARACEM ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (482,'DEBBDLUGG ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (483,'DEBBDWELD ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (484,'DEBBDZIPP ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (485,'DEBBXDENIM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (486,'DEBBXFISH ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (487,'DEBBXKNI  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (488,'DEBBXTEX  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (77,'DELTALIFE ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (78,'DELTASPINN');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (79,'DESCO     ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (80,'DESHBANDHU');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (81,'DHAKABANK ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (82,'DHAKAINS  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (83,'DSHGARME  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (84,'DULAMIACOT');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (85,'DUTCHBANGL');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (86,'EASTERNINS');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (87,'EASTLAND  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (88,'EASTRNLUB ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (89,'EBL       ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (90,'EBL1STMF  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (91,'EBLNRBMF  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (92,'ECABLES   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (93,'EHL       ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (515,'ENVOYTEX  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (526,'EXIM1STMF ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (94,'EXIMBANK  ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (524,'FAMILYTEX ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (528,'FAREASTFIN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (95,'FAREASTLIF');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (96,'FASFIN    ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (504,'FBFIF     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (97,'FEDERALINS');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (98,'FINEFOODS ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (99,'FIRSTSBANK');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (100,'FLEASEINT ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (254,'FUWANGCER ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (101,'FUWANGFOOD');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (509,'GBBPOWER  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (102,'GEMINISEA ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (514,'GENNEXT   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (519,'GHAIL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (520,'GHCL      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (103,'GLAXOSMITH');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (104,'GLOBALINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (105,'GOLDENSON ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (106,'GP        ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (506,'GPHISPAT  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (107,'GQBALLPEN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (108,'GRAMEEN1  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (109,'GRAMEENS2 ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (110,'GREENDELMF');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (111,'GREENDELT ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (505,'GSPFINANCE');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (112,'HAKKANIPUL');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (113,'HEIDELBCEM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (114,'HRTEX     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (115,'IBBLPBOND ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (116,'IBNSINA   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (117,'ICB       ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (118,'ICB1STNRB ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (119,'ICB2NDNRB ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (120,'ICB3RDNRB ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (147,'ICBAMCL2ND');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (148,'ICBEPMF1S1');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (149,'ICBIBANK  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (150,'ICBISLAMIC');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (523,'ICBSONALI1');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (151,'IDLC      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (152,'IFIC      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (153,'IFIC1STMF ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (154,'IFILISLMF1');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (155,'ILFSL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (156,'IMAMBUTTON');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (157,'INTECH    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (158,'IPDC      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (159,'ISLAMIBANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (160,'ISLAMICFIN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (161,'ISLAMIINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (162,'ISNLTD    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (163,'JAMUNABANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (164,'JAMUNAOIL ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (165,'JANATAINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (525,'JMISMDL   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (166,'JUTESPINN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (167,'KARNAPHULI');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (168,'KAY&QUE   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (169,'KEYACOSMET');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (170,'KOHINOOR  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (171,'KPCL      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (172,'LAFSURCEML');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (173,'LANKABAFIN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (174,'LEGACYFOOT');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (122,'LIBRAINFU ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (49,'LINDEBD   ');                                                        
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (467,'LRGLOBMF1 ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (123,'MAKSONSPIN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (124,'MALEKSPIN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (125,'MARICO    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (126,'MBL1STMF  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (127,'MEGCONMILK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (128,'MEGHNACEM ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (129,'MEGHNALIFE');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (130,'MEGHNAPET ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (131,'MERCANBANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (132,'MERCINS   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (133,'METROSPIN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (134,'MICEMENT  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (135,'MIDASFIN  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (136,'MIRACLEIND');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (137,'MITHUNKNIT');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (474,'MJLBD     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (138,'MODERNDYE ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (139,'MONNOCERA ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (141,'MONNOSTAF ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (142,'MPETROLEUM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (143,'MTBL      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (144,'NATLIFEINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (145,'NAVANACNG ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (146,'NBL       ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (175,'NCCBANK   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (508,'NCCBLMF1  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (176,'NHFIL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (177,'NITOLINS  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (503,'NLI1STMF  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (178,'NORTHERN  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (190,'NORTHRNINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (191,'NPOLYMAR  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (192,'NTC       ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (193,'NTLTUBES  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (195,'OLYMPIC   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (196,'ONEBANKLTD');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (197,'ORIONINFU ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (521,'ORIONPHARM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (507,'PADMALIFE ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (198,'PADMAOIL  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (199,'PARAMOUNT ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (200,'PEOPLESINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (201,'PF1STMF   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (202,'PHARMAID  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (203,'PHENIXINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (204,'PHOENIXFIN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (205,'PHPMF1    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (206,'PIONEERINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (207,'PLFSL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (208,'POPULAR1MF');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (209,'POPULARLIF');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (210,'POWERGRID ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (179,'PRAGATIINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (180,'PRAGATILIF');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (181,'PREMIERBAN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (518,'PREMIERCEM');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (182,'PREMIERLEA');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (183,'PRIME1ICBA');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (184,'PRIMEBANK ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (185,'PRIMEFIN  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (186,'PRIMEINSUR');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (187,'PRIMELIFE ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (188,'PRIMETEX  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (189,'PROGRESLIF');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (211,'PROVATIINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (2,'PTL       ');                                                         
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (212,'PUBALIBANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (213,'PURABIGEN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (214,'QSMDRYCELL');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (215,'RAHIMAFOOD');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (216,'RAHIMTEXT ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (217,'RAKCERAMIC');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (218,'RANFOUNDRY');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (140,'RDFOOD    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (219,'RECKITTBEN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (473,'RELIANCE1 ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (220,'RELIANCINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (221,'RENATA    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (222,'RENWICKJA ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (223,'REPUBLIC  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (224,'RNSPIN    ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (225,'RUPALIBANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (226,'RUPALIINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (227,'RUPALILIFE');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (242,'SAFKOSPINN');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (511,'SAIHAMCOT ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (244,'SAIHAMTEX ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (247,'SALAMCRST ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (250,'SALVOCHEM ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (251,'SAMATALETH');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (255,'SAMORITA  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (256,'SANDHANINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (257,'SAPORTL   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (258,'SAVAREFR  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (259,'SEBL1STMF ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (260,'SHAHJABANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (261,'SHYAMPSUG ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (262,'SIBL      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (264,'SINGERBD  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (267,'SINOBANGLA');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (269,'SONALIANSH');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (268,'SONARBAINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (266,'SONARGAON ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (265,'SOUTHEASTB');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (263,'SPCERAMICS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (516,'SPPCL     ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (253,'SQUARETEXT');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (252,'SQURPHARMA');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (249,'STANCERAM ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (248,'STANDARINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (246,'STANDBANKL');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (245,'STYLECRAFT');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (243,'SUMITPOWER');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (194,'SUNLIFEINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (270,'T05Y0715  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (271,'T05Y0815  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (272,'T10Y0117  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (273,'T10Y0118  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (274,'T10Y0119  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (275,'T10Y0121  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (276,'T10Y0214  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (277,'T10Y0215  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (278,'T10Y0216  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (279,'T10Y0217  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (280,'T10Y0218  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (281,'T10Y0219  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (282,'T10Y0220  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (283,'T10Y0221  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (284,'T10Y0317  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (285,'T10Y0318  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (286,'T10Y0319  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (287,'T10Y0320  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (288,'T10Y0321  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (289,'T10Y0414  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (290,'T10Y0415  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (291,'T10Y0416  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (292,'T10Y0418  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (293,'T10Y0419  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (294,'T10Y0420  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (295,'T10Y0421  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (296,'T10Y0517  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (297,'T10Y0518  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (298,'T10Y0519  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (299,'T10Y0520  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (477,'T10Y0521  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (300,'T10Y0614  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (301,'T10Y0615  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (302,'T10Y0616  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (303,'T10Y0617  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (304,'T10Y0618  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (305,'T10Y0619  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (306,'T10Y0620  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (478,'T10Y0621  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (307,'T10Y0717  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (308,'T10Y0718  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (309,'T10Y0719  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (310,'T10Y0720  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (441,'T10Y0721  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (311,'T10Y0814  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (312,'T10Y0816  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (313,'T10Y0817  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (314,'T10Y0818  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (315,'T10Y0819  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (316,'T10Y0820  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (492,'T10Y0821  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (317,'T10Y0916  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (318,'T10Y0917  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (319,'T10Y0918  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (320,'T10Y0919  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (321,'T10Y0920  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (499,'T10Y0921  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (322,'T10Y1014  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (323,'T10Y1016  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (324,'T10Y1017  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (325,'T10Y1018  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (326,'T10Y1019  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (327,'T10Y1116  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (328,'T10Y1117  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (329,'T10Y1118  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (330,'T10Y1120  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (331,'T10Y1213  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (332,'T10Y1214  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (333,'T10Y1215  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (334,'T10Y1216  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (335,'T10Y1217  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (336,'T10Y1218  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (337,'T10Y1219  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (338,'T10Y1220  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (339,'T15Y0123  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (340,'T15Y0124  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (341,'T15Y0125  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (342,'T15Y0223  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (343,'T15Y0224  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (344,'T15Y0225  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (345,'T15Y0226  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (346,'T15Y0323  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (347,'T15Y0324  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (348,'T15Y0325  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (349,'T15Y0326  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (350,'T15Y0423  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (351,'T15Y0424  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (352,'T15Y0425  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (353,'T15Y0426  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (354,'T15Y0523  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (355,'T15Y0524  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (356,'T15Y0525  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (479,'T15Y0526  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (357,'T15Y0623  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (358,'T15Y0624  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (359,'T15Y0625  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (481,'T15Y0626  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (360,'T15Y0722  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (361,'T15Y0723  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (362,'T15Y0724  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (363,'T15Y0725  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (364,'T15Y0822  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (365,'T15Y0823  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (366,'T15Y0824  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (367,'T15Y0825  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (495,'T15Y0826  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (368,'T15Y0922  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (369,'T15Y0923  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (370,'T15Y0924  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (371,'T15Y0925  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (496,'T15Y0926  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (372,'T15Y1022  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (373,'T15Y1023  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (374,'T15Y1024  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (375,'T15Y1025  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (376,'T15Y1122  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (377,'T15Y1123  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (378,'T15Y1125  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (379,'T15Y1222  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (380,'T15Y1223  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (381,'T15Y1224  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (382,'T15Y1225  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (383,'T20Y0128  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (384,'T20Y0129  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (385,'T20Y0131  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (386,'T20Y0228  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (387,'T20Y0229  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (388,'T20Y0230  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (389,'T20Y0231  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (390,'T20Y0328  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (391,'T20Y0329  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (392,'T20Y0330  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (393,'T20Y0428  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (394,'T20Y0429  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (395,'T20Y0430  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (480,'T20Y0431  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (396,'T20Y0528  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (397,'T20Y0530  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (466,'T20Y0531  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (398,'T20Y0628  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (399,'T20Y0629  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (400,'T20Y0630  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (493,'T20Y0631  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (401,'T20Y0727  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (402,'T20Y0728  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (403,'T20Y0729  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (404,'T20Y0730  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (494,'T20Y0731  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (405,'T20Y0827  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (406,'T20Y0828  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (407,'T20Y0829  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (408,'T20Y0830  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (497,'T20Y0831  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (409,'T20Y0927  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (410,'T20Y0928  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (411,'T20Y0930  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (498,'T20Y0931  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (412,'T20Y1027  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (413,'T20Y1028  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (414,'T20Y1029  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (415,'T20Y1030  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (416,'T20Y1127  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (417,'T20Y1128  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (418,'T20Y1130  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (419,'T20Y1227  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (420,'T20Y1228  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (421,'T20Y1229  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (422,'T20Y1230  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (423,'T5Y0112   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (424,'T5Y0113   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (425,'T5Y0114   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (426,'T5Y0115   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (427,'T5Y0116   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (428,'T5Y0212   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (429,'T5Y0213   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (430,'T5Y0214   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (431,'T5Y0215   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (432,'T5Y0216   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (433,'T5Y0313   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (434,'T5Y0314   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (435,'T5Y0315   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (436,'T5Y0316   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (437,'T5Y0412   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (438,'T5Y0414   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (439,'T5Y0415   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (475,'T5Y0416   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (440,'T5Y0514   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (476,'T5Y0516   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (442,'T5Y0613   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (443,'T5Y0615   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (489,'T5Y0616   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (444,'T5Y0712   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (445,'T5Y0713   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (446,'T5Y0714   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (490,'T5Y0716   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (447,'T5Y0811   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (448,'T5Y0812   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (449,'T5Y0813   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (450,'T5Y0814   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (491,'T5Y0816   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (451,'T5Y0911   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (452,'T5Y0912   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (453,'T5Y0913   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (454,'T5Y0914   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (455,'T5Y0915   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (500,'T5Y0916   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (456,'T5Y1011   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (457,'T5Y1012   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (458,'T5Y1013   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (459,'T5Y1014   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (460,'T5Y1015   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (461,'T5Y1111   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (462,'T5Y1112   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (463,'T5Y1113   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (464,'T5Y1114   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (465,'T5Y1115   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (468,'T5Y1211   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (469,'T5Y1212   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (470,'T5Y1213   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (471,'T5Y1214   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (472,'T5Y1215   ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (241,'TAKAFULINS');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (240,'TALLUSPIN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (239,'TITASGAS  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (238,'TRUSTB1MF ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (237,'TRUSTBANK ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (236,'UCBL      ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (235,'ULC       ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (234,'UNIONCAP  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (512,'UNIQUEHRL ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (233,'UNITEDAIR ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (232,'UNITEDINS ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (231,'USMANIAGL ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (230,'UTTARABANK');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (229,'UTTARAFIN ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (501,'ZAHINTEX  ');                                                       
  INSERT INTO instruments (`id`,`instrument_code`) VALUES (228,'ZEALBANGLA');                                                       
+----------------------------------------------------------------------------------------------------------------------------------+
529 rows in set (0.71 sec)



INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('11', 'Bank', 'Bank');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('21', 'Cement', 'Cement');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('24', 'Ceramics Sector', 'Ceramics Sector');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('26', 'Corporate Bond', 'Corporate Bond');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('91', 'Debenture', 'Debenture');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('13', 'Engineering', 'Engineering');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('28', 'Financial Institutions', 'Financial Institutions');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('14', 'Food & Allied', 'Food & Allied');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('15', 'Fuel & Power', 'Fuel & Power');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('25', 'Insurance', 'Insurance');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('22', 'IT Sector', 'IT Sector');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('16', 'Jute', 'Jute');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('19', 'Miscellaneous', 'Miscellaneous');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('12', 'Mutual Funds', 'Mutual Funds');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('19', 'Paper & Printing', 'Paper & Printing');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('18', 'Pharmaceuticals & Chemicals', 'Pharmaceuticals & Chemicals');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('20', 'Services & Real Estate', 'Services & Real Estate');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('23', 'Tannery Industries', 'Tannery Industries');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('27', 'Telecommunication', 'Telecommunication');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('17', 'Textile', 'Textile');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('29', 'Travel & Leisure', 'Travel & Leisure');
INSERT INTO `stock_sbnew`.`sectors` (`dse_sector_id`, `name`, `full_name`) VALUES ('88', 'Treasury Bond', 'Treasury Bond');


SELECT sectors.id, symbols.dse_code
FROM symbols
INNER JOIN sectors
ON symbols.business_segment=sectors.name;

UPDATE symbols
INNER JOIN sectors
ON symbols.business_segment=sectors.name
set symbols.sector_id=sectors.id

UPDATE instruments
INNER JOIN symbols
ON symbols.dse_code=instruments.instrument_code
set instruments.sector_id=symbols.sector_id


UPDATE `stock_sbnew`.`corporate_action`
INNER JOIN instruments
ON instruments.instrument_code=corporate_action.code
set corporate_action.instrument_id=instruments.id

UPDATE company_balance_sheets
INNER JOIN instruments
ON instruments.instrument_code=company_balance_sheets.company_name
set company_balance_sheets.instrument_id=instruments.id

UPDATE `stock_sbnew2`.`index_values` SET `index_time` = TIME_FORMAT(`date_time`, '%H:%i');
UPDATE `stock_sbnew2`.`index_values` SET `index_date` = DATE_FORMAT(`date_time`, '%Y-%m-%d');

SELECT `instrument_id`,2 as `fundamental_meta_id`,`inventories` as `meta_value`,CONCAT(year, '-01', '-01') as `meta_date` FROM `company_balance_sheets` WHERE 1

SELECT `symbol`,`code`,`action`,`value`,`premium`,FROM_UNIXTIME(`datestamp`,'%Y-%m-%d') AS `record_date` ,`datestamp`,`active` FROM `corporate_action` WHERE 1
