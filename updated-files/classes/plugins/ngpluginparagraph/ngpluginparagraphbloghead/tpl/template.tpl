<div class="sqpparabloghead sqpparabloghead{$introposition}" id="ngparabloghead{$uid}">

    {if isset($picturesource)}
    <img src="{$picturesource|escape}" width="{$picturewidth}" height="{$pictureheight}"  alt=""/>
    {/if}

    <div>
        {if isset($authorcaption)}
        {if isset($authorlink)}<a href="{$authorlink|escape}"{if isset($authorlinktarget)} target="{$authorlinktarget}"{/if}{if isset($authorlinkclass)} class="{$authorlinkclass}"{/if}>{/if}
        <img src="{$authorpicture|escape}"{if isset ($authorpicturehd)} srcset="{$authorpicture|escape} 1x, {$authorpicturehd|escape} 2x"{/if} width="64" height="64"  alt="{$authorcaption|escape}"/>
        {if isset($authorlink)}</a>{/if}
        {/if}

        <em>{$issuedate}{if isset($authorcaption)} {$by} {if isset($authorlink)}<a href="{$authorlink|escape}"{if isset($authorlinktarget)} target="{$authorlinktarget}"{/if}{if isset($authorlinkclass)} class="{$authorlinkclass}"{/if}>{/if}{$authorcaption|escape}{if isset($authorlink)}</a>{/if}{/if}</em>
        {if ($subheading!=='')}<h3>{$subheading|escape}</h3>{/if}
        {if ($heading!=='')}<h2>{$heading|escape}</h2>{/if}
        {$intro}

        {if isset($share)}
            <ul>
                {if isset($urlfacebook)}
                    <li><a href="{$urlfacebook|escape}" title="{$titlefacebook|escape}" target="_blank"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 13.8333,8.33334L 13.8333,6.15052C 13.8333,5.16512 14.051,4.66667 15.5807,4.66667L 17.5,4.66667L 17.5,1L 14.2974,1C 10.3729,1 9.07813,2.79896 9.07813,5.88697L 9.07813,8.33334L 6.5,8.33334L 6.5,12L 9.07813,12L 9.07813,23L 13.8333,23L 13.8333,12L 17.0646,12L 17.5,8.33334L 13.8333,8.33334 Z "/></svg></a></li>
                {/if}
                {if isset($urltwitter)}
                    <li><a href="{$urltwitter|escape}" title="{$titletwitter|escape}" target="_blank"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 23,5.17015C 22.1888,5.52913 21.3217,5.77154 20.408,5.88343C 21.3404,5.32399 22.0583,4.43821 22.394,3.38461C 21.5221,3.90207 20.5571,4.2797 19.5268,4.48018C 18.7016,3.59904 17.5268,3.04894 16.2308,3.04894C 13.7366,3.04894 11.718,5.07224 11.718,7.56642C 11.718,7.92073 11.7552,8.26572 11.8345,8.59672C 8.0816,8.41024 4.75293,6.6107 2.52914,3.87412C 2.1422,4.54078 1.91841,5.31934 1.91841,6.1445C 1.91841,7.71094 2.72029,9.09557 3.93241,9.90675C 3.18649,9.88811 2.48719,9.68296 1.88113,9.34264C 1.88113,9.36129 1.88113,9.37993 1.88113,9.3986C 1.88113,11.5897 3.43823,13.4126 5.50352,13.8275C 5.12589,13.9301 4.72495,13.986 4.3147,13.986C 4.02565,13.986 3.74126,13.958 3.46621,13.9021C 4.03963,15.6969 5.70864,17.0023 7.68533,17.0396C 6.1422,18.2517 4.19349,18.9743 2.07694,18.9743C 1.71329,18.9743 1.35433,18.951 1.00001,18.9091C 2.99068,20.2051 5.36366,20.951 7.90909,20.951C 16.2214,20.951 20.7623,14.0652 20.7623,8.09324C 20.7623,7.89742 20.7576,7.70161 20.7483,7.51048C 21.6294,6.87178 22.394,6.07924 23,5.17015 Z "/></svg></a></li>
                {/if}
                {if isset($urlgoogleplus)}
                    <li><a href="{$urlgoogleplus|escape}" title="{$titlegoogleplus|escape}" target="_blank"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 15.786,13.1173L 14.7443,12.3353L 14.7407,12.3323C 14.407,12.0701 14.1707,11.8562 14.1707,11.4913C 14.1707,11.0916 14.4599,10.8141 14.7948,10.4927L 14.8215,10.467C 15.9684,9.59805 17.3831,8.50322 17.3831,6.19678C 17.3831,4.65414 16.7006,3.63495 16.0498,2.89038L 16.7925,2.89038L 20.2475,1.00032L 12.6042,1.00032C 11.1537,1.00032 9.01416,1.18504 7.18821,2.63701L 7.18088,2.65133C 5.93178,3.68861 5.18611,5.20485 5.18611,6.70012C 5.18611,7.91415 5.68475,9.11473 6.5541,9.99035C 7.78139,11.2263 9.32059,11.4868 10.3957,11.4868C 10.4795,11.4868 10.5651,11.4852 10.6518,11.4814C 10.6083,11.6515 10.5802,11.8435 10.5802,12.0726C 10.5802,12.6984 10.788,13.178 11.0431,13.5729C 9.67064,13.6835 7.71271,13.9439 6.1807,14.8488C 3.92778,16.1411 3.75247,18.0491 3.75247,18.6032C 3.75247,20.7915 5.79757,22.9997 10.3665,22.9997C 15.6134,22.9997 18.3587,20.148 18.3587,17.3308C 18.3587,15.2025 17.0508,14.1424 15.786,13.1173 Z M 8.60505,5.34717C 8.60505,4.58205 8.77802,4.00368 9.13515,3.57739C 9.50822,3.12767 10.1764,2.82544 10.7977,2.82544C 11.9363,2.82544 12.6842,3.68501 13.1109,4.40609C 13.6378,5.29608 13.965,6.47342 13.965,7.47847C 13.965,7.76151 13.965,8.62298 13.3815,9.18501C 12.9834,9.56795 12.3101,9.83525 11.744,9.83525C 10.5698,9.83525 9.82804,8.99303 9.41257,8.28649C 8.8172,7.27367 8.60505,6.10405 8.60505,5.34717 Z M 15.5418,18.4104C 15.5418,19.9822 14.0979,20.9586 11.7732,20.9586C 9.02077,20.9586 7.17143,19.7786 7.17143,18.0225C 7.17143,16.5254 8.40512,15.9154 9.33639,15.5871C 10.4214,15.2398 11.8735,15.1687 12.2037,15.1687C 12.4274,15.1687 12.5523,15.1687 12.701,15.1819C 14.803,16.6258 15.5418,17.251 15.5418,18.4104 Z "/></svg></a></li>
                {/if}
                {if isset($urllinkedin)}
                    <li><a href="{$urllinkedin|escape}" title="{$titlelinkedin|escape}" target="_blank"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 21.2407,1L 2.87966,1C 1.8768,1 1.00002,1.72207 1.00002,2.71346L 1.00002,21.1146C 1.00002,22.1118 1.8768,23 2.87966,23L 21.2349,23C 22.2436,23 23,22.106 23,21.1146L 23,2.71346C 23.0057,1.72207 22.2436,1 21.2407,1 Z M 7.8195,19.3381L 4.66764,19.3381L 4.66764,9.53867L 7.8195,9.53867L 7.8195,19.3381 Z M 6.35245,8.04871L 6.32953,8.04871C 5.32093,8.04871 4.66764,7.29798 4.66764,6.35816C 4.66764,5.40113 5.33814,4.66762 6.36965,4.66762C 7.40117,4.66762 8.03154,5.39542 8.05446,6.35816C 8.05446,7.29798 7.40117,8.04871 6.35245,8.04871 Z M 19.3381,19.3381L 16.1863,19.3381L 16.1863,13.9799C 16.1863,12.6962 15.7278,11.8195 14.5874,11.8195C 13.7164,11.8195 13.2006,12.4097 12.9714,12.9828C 12.8854,13.1891 12.8625,13.4699 12.8625,13.7564L 12.8625,19.3381L 9.71061,19.3381L 9.71061,9.53867L 12.8625,9.53867L 12.8625,10.9026C 13.3209,10.2493 14.0373,9.30945 15.7049,9.30945C 17.7737,9.30945 19.3381,10.6733 19.3381,13.6131L 19.3381,19.3381 Z "/></svg></a></li>
                {/if}
                {if isset($urlxing)}
                    <li><a href="{$urlxing|escape}" title="{$titlexing|escape}" target="_blank"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 10.5734,9.73878C 10.4847,9.8984 9.34526,11.9202 7.15496,15.8042C 6.91553,16.2121 6.62733,16.4161 6.29037,16.4161L 3.11134,16.4161C 2.92512,16.4161 2.78767,16.3407 2.69899,16.19C 2.61032,16.0392 2.61032,15.8796 2.69899,15.7111L 6.06425,9.75208C 6.07312,9.75208 6.07312,9.74765 6.06425,9.73878L 3.92272,6.02769C 3.81631,5.83261 3.81188,5.66856 3.90942,5.53554C 3.98923,5.40253 4.13111,5.33602 4.33507,5.33602L 7.5141,5.33602C 7.8688,5.33602 8.16144,5.53554 8.39199,5.93458L 10.5734,9.73878 Z M 21.2943,1.19929C 21.3919,1.34117 21.3919,1.50522 21.2943,1.69144L 14.2712,14.1149L 14.2712,14.1282L 18.7405,22.3086C 18.838,22.4859 18.8425,22.65 18.7538,22.8007C 18.6651,22.9338 18.5232,23.0003 18.3281,23.0003L 15.1491,23.0003C 14.7767,23.0003 14.484,22.8007 14.2712,22.4017L 9.76203,14.1282C 9.92165,13.8445 12.276,9.66784 16.8251,1.59833C 17.0468,1.19929 17.3305,0.999769 17.6764,0.999769L 20.882,0.999769C 21.0771,0.999769 21.2145,1.06628 21.2943,1.19929 Z "/></svg></a></li>
                {/if}
                {if isset($urlmail)}
                    <li><a href="{$urlmail|escape}" title="{$titlemail|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 20.8,3.19991L 3.19999,3.19991C 1.98988,3.19991 1.01076,4.18981 1.01076,5.39991L 0.999988,18.5999C 0.999988,19.8095 1.98988,20.7999 3.19999,20.7999L 20.8,20.7999C 22.0096,20.7999 23,19.8095 23,18.5999L 23,5.39991C 23,4.18981 22.0096,3.19991 20.8,3.19991 Z M 20.8,18.5999L 3.19999,18.5999L 3.19999,7.59991L 12,13.0999L 20.8,7.59991L 20.8,18.5999 Z M 12,10.8999L 3.19999,5.39991L 20.8,5.39991L 12,10.8999 Z "/></svg></a></li>
                {/if}
            </ul>
        {/if}

    </div>

</div>