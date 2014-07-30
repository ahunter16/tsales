<?php
if (!empty($_REQUEST['reviewsub']))
{
	try 
	{
		$sql = 'INSERT INTO sales2.fbr_quote SET '.'
		intaccountid = :intaccountid,
		intticket = :intticket,
		strreference = :strreference,
		strpostcode = :strpostcode,
		inttemplateid = :inttemplateid,
		intquotestatusid = :intquotestatusid,
		OPTION (MAXDOP 1);';

		$s = $pdo2 -> prepare($sql);

		$s -> bindValue(':intaccountid', $_REQUEST['account']);;
		$s -> bindValue(':intticket', $_REQUEST['ticket']);;
		$s -> bindValue(':strreference', $_REQUEST['reference']);;
		$s -> bindValue(':strpostcode', $_REQUEST['postcode']);;
		$s -> bindValue(':inttemplateid', $_REQUEST['templateid']);;
		$s -> bindValue(':intquotestatusid', 20);;
        $s = $pdo2 -> prepare($sql);
        $s -> execute();
	}
	catch (PDOException $e)
	{
        $output = 'Error inserting to quote:' . $e->getMessage();
        include'output.html.php';
        exit();
    }

    try 
    {
    	$sql = 'SELECT id FROM sales2.fbr_quote WHERE id = SCOPE_IDENTITY()';
        $stmt = $pdo2->query($sql);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }

    catch (PDOException $e)
    {
        $output = 'Error getting quote:' . $e->getMessage();
        include'output.html.php';
        exit();
    }

    $quoteid = $stmt->fetch();

    $idstart = $_REQUEST['supplier'];
    $sv = substr($_REQUEST['supplier'], 1, -1);
    $mg = substr($_REQUEST['supplier'], -1);


    if ("i".$sv != "i5" && "i".$sv != "i4")
    {
        $in1 = "1yr";
        $in3 = "3yr";
    }
    else 
    {
        $in1 = "ins";
        $in3 = "ins";
    }

    foreach ($bandwidths as $bw)
    {
        try 
        {
        	$sql = 'INSERT INTO sales2.fbr_quote_detail SET '.'
        	intquoteid = :quoteid,
        	intbandwidth = :bandwidth,

        	intserviceid = :serviceid,
        	flo1yearinstall = :1yrins,
        	flo1yearrental = :1yrrent,

        	flo1yearirentalmargin = :1yrrentmar,
        	flo3yearinstall = :3yrins,
        	flo3yearrental = :3yrrent,

        	flo3yearirentalmargin = :3yrrentmar, OPTION (MAXDOP 1)';
/*          flo1yearinstallmargin = :1yrinsmar,
            flo3yearinstallmargin = :3yrinsmar,
            intperiod = :period,*/

            $s = $pdo2 -> prepare($sql);
            
            $s -> bindValue(':quoteid', $quoteid);
            $s -> bindValue(':bandwidth', $bw);
            //$s -> bindValue(':period', $_REQUEST[''])
            $s -> bindValue(':serviceid', $sv);
            $s -> bindValue(':1yrins', $_REQUEST[$idstart.$in1.$bw]);
            $s -> bindValue(':1yrrent', $_REQUEST[$idstart."1".$bw]);
           // $s -> bindValue(':1yrinsmar', $_REQUEST[])
            $s -> bindValue(':1yrrentmar', $_REQUEST["i".$sv."mar".$bw]);
            $s -> bindValue(':3yrins', $_REQUEST[$idstart.$in3.$bw]);;
            $s -> bindValue(':3yrrent', $_REQUEST[$idstart."3".$bw]);
            //$s -> bindValue(':3yrinsmar', $_REQUEST[])
            $s -> bindValue(':3yrrentmar', $_REQUEST["i".$sv."mar".$bw]);

            $s = $pdo2 -> prepare($sql);
            $s -> execute();


            /*'.$quoteid["id"].'*/
        }

        catch (PDOException $e)
        {
            $output = 'Error inserting to quote:_detail' . $e->getMessage();
            include'output.html.php';
            exit();
        }

    }


    try 
    {
        $sql = 'INSERT INTO sales2.fbr_quote_history SET '.'
        intquoteid = :quoteid,
        intstaffid = :staffid,
        intquotestatusid = :status, OPTION (MAXDOP 1)';

        $s = $pdo2 -> prepare($sql);

        $s -> bindValue(':quoteid', $quoteid);
        $s -> bindValue(':staffid', $staffid);
        $s -> bindValue(':status', 20);

        $s = $pdo2 -> prepare($sql);
        $s -> execute();
    }

    catch (PDOException $e)
    {
        $output = 'Error inserting to quote_history:' . $e->getMessage();
        include'output.html.php';
        exit();
    }

    try 
    {
        $sql = 'INSERT INTO sales2.fbr_quote_pricing SET '.'
        intquoteid = :quoteid,
        intbandwidth = :bandwidth,

        intserviceid = :serviceid,
        flo1yearinstall = :1yrins,
        flo1yearrental = :1yrrent,
       
        flo1yearirentalmargin = :1yrrentmar,
        flo3yearinstall = :3yrins,
        flo3yearrental = :3yrrent,
        
        flo3yearirentalmargin = :3yrrentmar, OPTION (MAXDOP 1)';

         /*flo1yearinstallmargin = :1yrinsmar,
        flo3yearinstallmargin = :3yrinsmar,*/

        $s -> bindValue(':quoteid', $quoteid);
        $s -> bindValue(':bandwidth', $bw);
        $s -> bindValue(':serviceid', $sv);
        $s -> bindValue(':1yrins', $_REQUEST[$idstart.$in1.$bw]);
        $s -> bindValue(':1yrrent', $_REQUEST[$idstart."1".$bw]);
        $s -> bindValue(':1yrrentmar', $_REQUEST["i".$sv."mar".$bw]);
        $s -> bindValue(':3yrins', $_REQUEST[$idstart.$in3.$bw]);
        $s -> bindValue(':3yrrent', $_REQUEST[$idstart."3".$bw]);
        $s -> bindValue(':3yrrentmar', $_REQUEST["i".$sv."mar".$bw]);

        $s = $pdo2 -> prepare($sql);
        $s -> execute();
    }
    catch (PDOException $e)
    {
        $output = 'Error inserting to quote_pricing:' . $e->getMessage();
        include'output.html.php';
        exit();
    }
    

}
