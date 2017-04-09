<?php

namespace Tests\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use AppBundle\Command\LoadUsersCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class LoadUsersCommandTest extends KernelTestCase
{
    public function setUp()
    {
        self::bootKernel();

        // Ensure that the database is cleaned up after tests run
        $this->container = self::$kernel->getContainer();
        $this->container
            ->get('doctrine.orm.entity_manager')
            ->getConnection()
            ->beginTransaction();
    }

    public function tearDown()
    {
        // Rollback so database is clean after finishing
        $this->container
            ->get('doctrine.orm.entity_manager')
            ->getConnection()->rollback();
    }

    public function testLoadUsersSuccess()
    {
        $application = new Application(self::$kernel);
        $application->add(new LoadUsersCommand());

        $command = $application->find('app:load-users');
        $commandTester = new CommandTester($command);

        $commandTester->execute(array(
            'command' => $command->getName(),
            'csv_file' => 'tests/AppBundle/Command/user-data.csv',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertNotContains('first_name=﻿first_name, last_name=last_name, email=email', $output);
        $this->assertContains('first_name=Matthew, last_name=Watkins, email=mwatkins0@google.com.hk', $output);
        $this->assertContains('first_name=Philip, last_name=Myers, email=pmyers1@qq.com', $output);
        $this->assertContains('first_name=Sandra, last_name=Adams, email=sadams2@barnesandnoble.com', $output);
        $this->assertContains('first_name=Justin, last_name=Mills, email=jmills3@prnewswire.com', $output);
        $this->assertContains('first_name=Anne, last_name=Miller, email=amiller4@timesonline.co.uk', $output);
        $this->assertContains('first_name=Helen, last_name=Miller, email=hmiller5@bloglovin.com', $output);
        $this->assertContains('first_name=Martin, last_name=Evans, email=mevans6@twitter.com', $output);
        $this->assertContains('first_name=Harry, last_name=Baker, email=hbaker7@canalblog.com', $output);
        $this->assertContains('first_name=Bruce, last_name=Arnold, email=barnold8@51.la', $output);
        $this->assertContains('first_name=Earl, last_name=Bowman, email=ebowman9@businessinsider.com', $output);
        $this->assertContains('first_name=Janice, last_name=Cunningham, email=jcunninghama@buzzfeed.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Clark, email=eclarkb@huffingtonpost.com', $output);
        $this->assertContains('first_name=Joseph, last_name=Armstrong, email=jarmstrongc@prlog.org', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturnerd@pagesperso-orange.fr', $output);
        $this->assertContains('first_name=Frances, last_name=Warren, email=fwarrene@bloomberg.com', $output);
        $this->assertContains('first_name=Christina, last_name=Dunn, email=cdunnf@github.io', $output);
        $this->assertContains('first_name=Jennifer, last_name=Castillo, email=jcastillog@ovh.net', $output);
        $this->assertContains('first_name=Jennifer, last_name=Garcia, email=jgarciah@baidu.com', $output);
        $this->assertContains('first_name=Robin, last_name=Edwards, email=redwardsi@alibaba.com', $output);
        $this->assertContains('first_name=Robin, last_name=Franklin, email=rfranklinj@ifeng.com', $output);
        $this->assertContains('first_name=Cheryl, last_name=Wells, email=cwellsk@abc.net.au', $output);
        $this->assertContains('first_name=Janice, last_name=Mccoy, email=jmccoyl@wikipedia.org', $output);
        $this->assertContains('first_name=Louis, last_name=Harris, email=lharrism@geocities.com', $output);
        $this->assertContains('first_name=Irene, last_name=Perez, email=iperezn@si.edu', $output);
        $this->assertContains('first_name=Kimberly, last_name=Jenkins, email=kjenkinso@mysql.com', $output);
        $this->assertContains('first_name=Jonathan, last_name=Ford, email=jfordp@hao123.com', $output);
        $this->assertContains('first_name=Betty, last_name=Lawson, email=blawsonq@cnet.com', $output);
        $this->assertContains('first_name=Bobby, last_name=Gilbert, email=bgilbertr@mac.com', $output);
        $this->assertContains('first_name=Jessica, last_name=Burton, email=jburtons@canalblog.com', $output);
        $this->assertContains('first_name=Barbara, last_name=Austin, email=baustint@webs.com', $output);
        $this->assertContains('first_name=Katherine, last_name=Reid, email=kreidu@mail.ru', $output);
        $this->assertContains('first_name=Ronald, last_name=Watson, email=rwatsonv@creativecommons.org', $output);
        $this->assertContains('first_name=Douglas, last_name=Stephens, email=dstephensw@ustream.tv', $output);
        $this->assertContains('first_name=Kevin, last_name=Henderson, email=khendersonx@multiply.com', $output);
        $this->assertContains('first_name=Judith, last_name=Reid, email=jreidy@networkadvertising.org', $output);
        $this->assertContains('first_name=Eric, last_name=Crawford, email=ecrawfordz@odnoklassniki.ru', $output);
        $this->assertContains('first_name=Henry, last_name=Fowler, email=hfowler10@desdev.cn', $output);
        $this->assertContains('first_name=Elizabeth, last_name=Welch, email=ewelch11@youtu.be', $output);
        $this->assertContains('first_name=Jimmy, last_name=Daniels, email=jdaniels12@ted.com', $output);
        $this->assertContains('first_name=Raymond, last_name=Williams, email=rwilliams13@reddit.com', $output);
        $this->assertContains('first_name=Deborah, last_name=Shaw, email=dshaw14@dailymail.co.uk', $output);
        $this->assertContains('first_name=Richard, last_name=Wagner, email=rwagner15@e-recht24.de', $output);
        $this->assertContains('first_name=Evelyn, last_name=Franklin, email=efranklin16@123-reg.co.uk', $output);
        $this->assertContains('first_name=Brian, last_name=Hamilton, email=bhamilton17@hexun.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturner18@yellowbook.com', $output);
        $this->assertContains('first_name=Billy, last_name=Hanson, email=bhanson19@hud.gov', $output);
        $this->assertContains('first_name=Emily, last_name=Black, email=eblack1a@state.tx.us', $output);
        $this->assertContains('first_name=Joyce, last_name=Fowler, email=jfowler1b@addtoany.com', $output);
        $this->assertContains('first_name=Gregory, last_name=Weaver, email=gweaver1c@google.ru', $output);
        $this->assertContains('first_name=Robin, last_name=Griffin, email=rgriffin1d@xing.com', $output);
        $this->assertContains('first_name=Shirley, last_name=Andrews, email=sandrews1e@seesaa.net', $output);
        $this->assertContains('first_name=Deborah, last_name=Kim, email=dkim1f@earthlink.net', $output);
        $this->assertContains('first_name=Dorothy, last_name=Hughes, email=dhughes1g@noaa.gov', $output);
        $this->assertContains('first_name=Jimmy, last_name=Banks, email=jbanks1h@sohu.com', $output);
        $this->assertContains('first_name=Norma, last_name=Howell, email=nhowell1i@statcounter.com', $output);
        $this->assertContains('first_name=Anthony, last_name=Gardner, email=agardner1j@dailymail.co.uk', $output);
        $this->assertContains('first_name=Ruby, last_name=Cook, email=rcook1k@wix.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Rice, email=srice1l@huffingtonpost.com', $output);
        $this->assertContains('first_name=Marie, last_name=Webb, email=mwebb1m@cnbc.com', $output);
        $this->assertContains('first_name=Jesse, last_name=Hanson, email=jhanson1n@independent.co.uk', $output);
        $this->assertContains('first_name=Dorothy, last_name=Foster, email=dfoster1o@epa.gov', $output);
        $this->assertContains('first_name=Frank, last_name=Andrews, email=fandrews1p@nih.gov', $output);
        $this->assertContains('first_name=Ruby, last_name=Sanders, email=rsanders1q@diigo.com', $output);
        $this->assertContains('first_name=Peter, last_name=Frazier, email=pfrazier1r@istockphoto.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Stephens, email=sstephens1s@imdb.com', $output);
        $this->assertContains('first_name=Gary, last_name=Pierce, email=gpierce1t@sphinn.com', $output);
        $this->assertContains('first_name=Alan, last_name=Lawson, email=alawson1u@cbc.ca', $output);
        $this->assertContains('first_name=Roger, last_name=Daniels, email=rdaniels1v@archive.org', $output);
        $this->assertContains('first_name=Marie, last_name=Cooper, email=mcooper1w@moonfruit.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Bryant, email=tbryant1x@intel.com', $output);
        $this->assertContains('first_name=Phillip, last_name=Owens, email=powens1y@lycos.com', $output);
        $this->assertContains('first_name=Jennifer, last_name=Barnes, email=jbarnes1z@myspace.com', $output);
        $this->assertContains('first_name=William, last_name=Shaw, email=wshaw20@sogou.com', $output);
        $this->assertContains('first_name=Kathryn, last_name=Montgomery, email=kmontgomery21@youku.com', $output);
        $this->assertContains('first_name=Frank, last_name=Cruz, email=fcruz22@mtv.com', $output);
        $this->assertContains('first_name=David, last_name=Woods, email=dwoods23@issuu.com', $output);
        $this->assertContains('first_name=Jose, last_name=Gonzales, email=jgonzales24@wufoo.com', $output);
        $this->assertContains('first_name=Clarence, last_name=Simmons, email=csimmons25@topsy.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Ross, email=mross26@live.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Kelly, email=ekelly27@hud.gov', $output);
        $this->assertContains('first_name=Eric, last_name=Rose, email=erose28@usgs.gov', $output);
        $this->assertContains('first_name=Denise, last_name=Gutierrez, email=dgutierrez29@4shared.com', $output);
        $this->assertContains('first_name=Lisa, last_name=Howard, email=lhoward2a@mozilla.org', $output);
        $this->assertContains('first_name=Kimberly, last_name=Hart, email=khart2b@tripadvisor.com', $output);
        $this->assertContains('first_name=Ronald, last_name=Elliott, email=relliott2c@sciencedaily.com', $output);
        $this->assertContains('first_name=Frank, last_name=Hernandez, email=fhernandez2d@about.com', $output);
        $this->assertContains('first_name=Judy, last_name=Austin, email=jaustin2e@google.de', $output);
        $this->assertContains('first_name=Jeffrey, last_name=Webb, email=jwebb2f@digg.com', $output);
        $this->assertContains('first_name=Jerry, last_name=Mcdonald, email=jmcdonald2g@reuters.com', $output);
        $this->assertContains('first_name=Shawn, last_name=Berry, email=sberry2h@auda.org.au', $output);
        $this->assertContains('first_name=Timothy, last_name=Carr, email=tcarr2i@mlb.com', $output);
        $this->assertContains('first_name=Kimberly, last_name=Lee, email=klee2j@paginegialle.it', $output);
        $this->assertContains('first_name=Cynthia, last_name=Brown, email=cbrown2k@aboutads.info', $output);
        $this->assertContains('first_name=Jessica, last_name=Morales, email=jmorales2l@webeden.co.uk', $output);
        $this->assertContains('first_name=Jane, last_name=Frazier, email=jfrazier2m@biblegateway.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Hart, email=thart2n@friendfeed.com', $output);
        $this->assertContains('first_name=Chris, last_name=Dunn, email=cdunn2o@cornell.edu', $output);
        $this->assertContains('first_name=Dorothy, last_name=Barnes, email=dbarnes2p@marketwatch.com', $output);
        $this->assertContains('first_name=Arthur, last_name=King, email=aking2q@smh.com.au', $output);
        $this->assertContains('first_name=Jason, last_name=Ross, email=jross2r@desdev.cn', $output);
    }

    /**
     * Validate that running the load users command successfully updates the first name, last name and leaves
     * the email and password intact
     */
    public function testLoadUsersMultipleTimesSuccess()
    {
        $application = new Application(self::$kernel);
        $application->add(new LoadUsersCommand());

        $command = $application->find('app:load-users');
        $commandTester = new CommandTester($command);

        $commandTester->execute(array(
            'command' => $command->getName(),
            'csv_file' => 'tests/AppBundle/Command/user-data.csv',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertNotContains('first_name=﻿first_name, last_name=last_name, email=email', $output);
        $this->assertContains('first_name=Matthew, last_name=Watkins, email=mwatkins0@google.com.hk', $output);
        $this->assertContains('first_name=Philip, last_name=Myers, email=pmyers1@qq.com', $output);
        $this->assertContains('first_name=Sandra, last_name=Adams, email=sadams2@barnesandnoble.com', $output);
        $this->assertContains('first_name=Justin, last_name=Mills, email=jmills3@prnewswire.com', $output);
        $this->assertContains('first_name=Anne, last_name=Miller, email=amiller4@timesonline.co.uk', $output);
        $this->assertContains('first_name=Helen, last_name=Miller, email=hmiller5@bloglovin.com', $output);
        $this->assertContains('first_name=Martin, last_name=Evans, email=mevans6@twitter.com', $output);
        $this->assertContains('first_name=Harry, last_name=Baker, email=hbaker7@canalblog.com', $output);
        $this->assertContains('first_name=Bruce, last_name=Arnold, email=barnold8@51.la', $output);
        $this->assertContains('first_name=Earl, last_name=Bowman, email=ebowman9@businessinsider.com', $output);
        $this->assertContains('first_name=Janice, last_name=Cunningham, email=jcunninghama@buzzfeed.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Clark, email=eclarkb@huffingtonpost.com', $output);
        $this->assertContains('first_name=Joseph, last_name=Armstrong, email=jarmstrongc@prlog.org', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturnerd@pagesperso-orange.fr', $output);
        $this->assertContains('first_name=Frances, last_name=Warren, email=fwarrene@bloomberg.com', $output);
        $this->assertContains('first_name=Christina, last_name=Dunn, email=cdunnf@github.io', $output);
        $this->assertContains('first_name=Jennifer, last_name=Castillo, email=jcastillog@ovh.net', $output);
        $this->assertContains('first_name=Jennifer, last_name=Garcia, email=jgarciah@baidu.com', $output);
        $this->assertContains('first_name=Robin, last_name=Edwards, email=redwardsi@alibaba.com', $output);
        $this->assertContains('first_name=Robin, last_name=Franklin, email=rfranklinj@ifeng.com', $output);
        $this->assertContains('first_name=Cheryl, last_name=Wells, email=cwellsk@abc.net.au', $output);
        $this->assertContains('first_name=Janice, last_name=Mccoy, email=jmccoyl@wikipedia.org', $output);
        $this->assertContains('first_name=Louis, last_name=Harris, email=lharrism@geocities.com', $output);
        $this->assertContains('first_name=Irene, last_name=Perez, email=iperezn@si.edu', $output);
        $this->assertContains('first_name=Kimberly, last_name=Jenkins, email=kjenkinso@mysql.com', $output);
        $this->assertContains('first_name=Jonathan, last_name=Ford, email=jfordp@hao123.com', $output);
        $this->assertContains('first_name=Betty, last_name=Lawson, email=blawsonq@cnet.com', $output);
        $this->assertContains('first_name=Bobby, last_name=Gilbert, email=bgilbertr@mac.com', $output);
        $this->assertContains('first_name=Jessica, last_name=Burton, email=jburtons@canalblog.com', $output);
        $this->assertContains('first_name=Barbara, last_name=Austin, email=baustint@webs.com', $output);
        $this->assertContains('first_name=Katherine, last_name=Reid, email=kreidu@mail.ru', $output);
        $this->assertContains('first_name=Ronald, last_name=Watson, email=rwatsonv@creativecommons.org', $output);
        $this->assertContains('first_name=Douglas, last_name=Stephens, email=dstephensw@ustream.tv', $output);
        $this->assertContains('first_name=Kevin, last_name=Henderson, email=khendersonx@multiply.com', $output);
        $this->assertContains('first_name=Judith, last_name=Reid, email=jreidy@networkadvertising.org', $output);
        $this->assertContains('first_name=Eric, last_name=Crawford, email=ecrawfordz@odnoklassniki.ru', $output);
        $this->assertContains('first_name=Henry, last_name=Fowler, email=hfowler10@desdev.cn', $output);
        $this->assertContains('first_name=Elizabeth, last_name=Welch, email=ewelch11@youtu.be', $output);
        $this->assertContains('first_name=Jimmy, last_name=Daniels, email=jdaniels12@ted.com', $output);
        $this->assertContains('first_name=Raymond, last_name=Williams, email=rwilliams13@reddit.com', $output);
        $this->assertContains('first_name=Deborah, last_name=Shaw, email=dshaw14@dailymail.co.uk', $output);
        $this->assertContains('first_name=Richard, last_name=Wagner, email=rwagner15@e-recht24.de', $output);
        $this->assertContains('first_name=Evelyn, last_name=Franklin, email=efranklin16@123-reg.co.uk', $output);
        $this->assertContains('first_name=Brian, last_name=Hamilton, email=bhamilton17@hexun.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturner18@yellowbook.com', $output);
        $this->assertContains('first_name=Billy, last_name=Hanson, email=bhanson19@hud.gov', $output);
        $this->assertContains('first_name=Emily, last_name=Black, email=eblack1a@state.tx.us', $output);
        $this->assertContains('first_name=Joyce, last_name=Fowler, email=jfowler1b@addtoany.com', $output);
        $this->assertContains('first_name=Gregory, last_name=Weaver, email=gweaver1c@google.ru', $output);
        $this->assertContains('first_name=Robin, last_name=Griffin, email=rgriffin1d@xing.com', $output);
        $this->assertContains('first_name=Shirley, last_name=Andrews, email=sandrews1e@seesaa.net', $output);
        $this->assertContains('first_name=Deborah, last_name=Kim, email=dkim1f@earthlink.net', $output);
        $this->assertContains('first_name=Dorothy, last_name=Hughes, email=dhughes1g@noaa.gov', $output);
        $this->assertContains('first_name=Jimmy, last_name=Banks, email=jbanks1h@sohu.com', $output);
        $this->assertContains('first_name=Norma, last_name=Howell, email=nhowell1i@statcounter.com', $output);
        $this->assertContains('first_name=Anthony, last_name=Gardner, email=agardner1j@dailymail.co.uk', $output);
        $this->assertContains('first_name=Ruby, last_name=Cook, email=rcook1k@wix.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Rice, email=srice1l@huffingtonpost.com', $output);
        $this->assertContains('first_name=Marie, last_name=Webb, email=mwebb1m@cnbc.com', $output);
        $this->assertContains('first_name=Jesse, last_name=Hanson, email=jhanson1n@independent.co.uk', $output);
        $this->assertContains('first_name=Dorothy, last_name=Foster, email=dfoster1o@epa.gov', $output);
        $this->assertContains('first_name=Frank, last_name=Andrews, email=fandrews1p@nih.gov', $output);
        $this->assertContains('first_name=Ruby, last_name=Sanders, email=rsanders1q@diigo.com', $output);
        $this->assertContains('first_name=Peter, last_name=Frazier, email=pfrazier1r@istockphoto.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Stephens, email=sstephens1s@imdb.com', $output);
        $this->assertContains('first_name=Gary, last_name=Pierce, email=gpierce1t@sphinn.com', $output);
        $this->assertContains('first_name=Alan, last_name=Lawson, email=alawson1u@cbc.ca', $output);
        $this->assertContains('first_name=Roger, last_name=Daniels, email=rdaniels1v@archive.org', $output);
        $this->assertContains('first_name=Marie, last_name=Cooper, email=mcooper1w@moonfruit.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Bryant, email=tbryant1x@intel.com', $output);
        $this->assertContains('first_name=Phillip, last_name=Owens, email=powens1y@lycos.com', $output);
        $this->assertContains('first_name=Jennifer, last_name=Barnes, email=jbarnes1z@myspace.com', $output);
        $this->assertContains('first_name=William, last_name=Shaw, email=wshaw20@sogou.com', $output);
        $this->assertContains('first_name=Kathryn, last_name=Montgomery, email=kmontgomery21@youku.com', $output);
        $this->assertContains('first_name=Frank, last_name=Cruz, email=fcruz22@mtv.com', $output);
        $this->assertContains('first_name=David, last_name=Woods, email=dwoods23@issuu.com', $output);
        $this->assertContains('first_name=Jose, last_name=Gonzales, email=jgonzales24@wufoo.com', $output);
        $this->assertContains('first_name=Clarence, last_name=Simmons, email=csimmons25@topsy.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Ross, email=mross26@live.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Kelly, email=ekelly27@hud.gov', $output);
        $this->assertContains('first_name=Eric, last_name=Rose, email=erose28@usgs.gov', $output);
        $this->assertContains('first_name=Denise, last_name=Gutierrez, email=dgutierrez29@4shared.com', $output);
        $this->assertContains('first_name=Lisa, last_name=Howard, email=lhoward2a@mozilla.org', $output);
        $this->assertContains('first_name=Kimberly, last_name=Hart, email=khart2b@tripadvisor.com', $output);
        $this->assertContains('first_name=Ronald, last_name=Elliott, email=relliott2c@sciencedaily.com', $output);
        $this->assertContains('first_name=Frank, last_name=Hernandez, email=fhernandez2d@about.com', $output);
        $this->assertContains('first_name=Judy, last_name=Austin, email=jaustin2e@google.de', $output);
        $this->assertContains('first_name=Jeffrey, last_name=Webb, email=jwebb2f@digg.com', $output);
        $this->assertContains('first_name=Jerry, last_name=Mcdonald, email=jmcdonald2g@reuters.com', $output);
        $this->assertContains('first_name=Shawn, last_name=Berry, email=sberry2h@auda.org.au', $output);
        $this->assertContains('first_name=Timothy, last_name=Carr, email=tcarr2i@mlb.com', $output);
        $this->assertContains('first_name=Kimberly, last_name=Lee, email=klee2j@paginegialle.it', $output);
        $this->assertContains('first_name=Cynthia, last_name=Brown, email=cbrown2k@aboutads.info', $output);
        $this->assertContains('first_name=Jessica, last_name=Morales, email=jmorales2l@webeden.co.uk', $output);
        $this->assertContains('first_name=Jane, last_name=Frazier, email=jfrazier2m@biblegateway.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Hart, email=thart2n@friendfeed.com', $output);
        $this->assertContains('first_name=Chris, last_name=Dunn, email=cdunn2o@cornell.edu', $output);
        $this->assertContains('first_name=Dorothy, last_name=Barnes, email=dbarnes2p@marketwatch.com', $output);
        $this->assertContains('first_name=Arthur, last_name=King, email=aking2q@smh.com.au', $output);
        $this->assertContains('first_name=Jason, last_name=Ross, email=jross2r@desdev.cn', $output);

        // Now perform the update again with the file that contains a few entries with updated names
        $commandTester->execute(array(
            'command' => $command->getName(),
            'csv_file' => 'tests/AppBundle/Command/user-data-updated.csv',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertNotContains('first_name=﻿first_name, last_name=last_name, email=email', $output);
        $this->assertContains('first_name=Matthew2, last_name=Watkins2, email=mwatkins0@google.com.hk', $output);
        $this->assertContains('first_name=Philip2, last_name=Myers2, email=pmyers1@qq.com', $output);
        $this->assertContains('first_name=Sandra, last_name=Adams, email=sadams2@barnesandnoble.com', $output);
        $this->assertContains('first_name=Justin, last_name=Mills, email=jmills3@prnewswire.com', $output);
        $this->assertContains('first_name=Anne, last_name=Miller, email=amiller4@timesonline.co.uk', $output);
        $this->assertContains('first_name=Helen, last_name=Miller, email=hmiller5@bloglovin.com', $output);
        $this->assertContains('first_name=Martin, last_name=Evans, email=mevans6@twitter.com', $output);
        $this->assertContains('first_name=Harry, last_name=Baker, email=hbaker7@canalblog.com', $output);
        $this->assertContains('first_name=Bruce, last_name=Arnold, email=barnold8@51.la', $output);
        $this->assertContains('first_name=Earl, last_name=Bowman, email=ebowman9@businessinsider.com', $output);
        $this->assertContains('first_name=Janice, last_name=Cunningham, email=jcunninghama@buzzfeed.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Clark, email=eclarkb@huffingtonpost.com', $output);
        $this->assertContains('first_name=Joseph, last_name=Armstrong, email=jarmstrongc@prlog.org', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturnerd@pagesperso-orange.fr', $output);
        $this->assertContains('first_name=Frances, last_name=Warren, email=fwarrene@bloomberg.com', $output);
        $this->assertContains('first_name=Christina, last_name=Dunn, email=cdunnf@github.io', $output);
        $this->assertContains('first_name=Jennifer, last_name=Castillo, email=jcastillog@ovh.net', $output);
        $this->assertContains('first_name=Jennifer, last_name=Garcia, email=jgarciah@baidu.com', $output);
        $this->assertContains('first_name=Robin, last_name=Edwards, email=redwardsi@alibaba.com', $output);
        $this->assertContains('first_name=Robin, last_name=Franklin, email=rfranklinj@ifeng.com', $output);
        $this->assertContains('first_name=Cheryl, last_name=Wells, email=cwellsk@abc.net.au', $output);
        $this->assertContains('first_name=Janice, last_name=Mccoy, email=jmccoyl@wikipedia.org', $output);
        $this->assertContains('first_name=Louis, last_name=Harris, email=lharrism@geocities.com', $output);
        $this->assertContains('first_name=Irene, last_name=Perez, email=iperezn@si.edu', $output);
        $this->assertContains('first_name=Kimberly, last_name=Jenkins, email=kjenkinso@mysql.com', $output);
        $this->assertContains('first_name=Jonathan, last_name=Ford, email=jfordp@hao123.com', $output);
        $this->assertContains('first_name=Betty, last_name=Lawson, email=blawsonq@cnet.com', $output);
        $this->assertContains('first_name=Bobby, last_name=Gilbert, email=bgilbertr@mac.com', $output);
        $this->assertContains('first_name=Jessica, last_name=Burton, email=jburtons@canalblog.com', $output);
        $this->assertContains('first_name=Barbara, last_name=Austin, email=baustint@webs.com', $output);
        $this->assertContains('first_name=Katherine, last_name=Reid, email=kreidu@mail.ru', $output);
        $this->assertContains('first_name=Ronald, last_name=Watson, email=rwatsonv@creativecommons.org', $output);
        $this->assertContains('first_name=Douglas, last_name=Stephens, email=dstephensw@ustream.tv', $output);
        $this->assertContains('first_name=Kevin, last_name=Henderson, email=khendersonx@multiply.com', $output);
        $this->assertContains('first_name=Judith, last_name=Reid, email=jreidy@networkadvertising.org', $output);
        $this->assertContains('first_name=Eric, last_name=Crawford, email=ecrawfordz@odnoklassniki.ru', $output);
        $this->assertContains('first_name=Henry, last_name=Fowler, email=hfowler10@desdev.cn', $output);
        $this->assertContains('first_name=Elizabeth, last_name=Welch, email=ewelch11@youtu.be', $output);
        $this->assertContains('first_name=Jimmy, last_name=Daniels, email=jdaniels12@ted.com', $output);
        $this->assertContains('first_name=Raymond, last_name=Williams, email=rwilliams13@reddit.com', $output);
        $this->assertContains('first_name=Deborah, last_name=Shaw, email=dshaw14@dailymail.co.uk', $output);
        $this->assertContains('first_name=Richard, last_name=Wagner, email=rwagner15@e-recht24.de', $output);
        $this->assertContains('first_name=Evelyn, last_name=Franklin, email=efranklin16@123-reg.co.uk', $output);
        $this->assertContains('first_name=Brian, last_name=Hamilton, email=bhamilton17@hexun.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Turner, email=mturner18@yellowbook.com', $output);
        $this->assertContains('first_name=Billy, last_name=Hanson, email=bhanson19@hud.gov', $output);
        $this->assertContains('first_name=Emily, last_name=Black, email=eblack1a@state.tx.us', $output);
        $this->assertContains('first_name=Joyce, last_name=Fowler, email=jfowler1b@addtoany.com', $output);
        $this->assertContains('first_name=Gregory, last_name=Weaver, email=gweaver1c@google.ru', $output);
        $this->assertContains('first_name=Robin, last_name=Griffin, email=rgriffin1d@xing.com', $output);
        $this->assertContains('first_name=Shirley, last_name=Andrews, email=sandrews1e@seesaa.net', $output);
        $this->assertContains('first_name=Deborah, last_name=Kim, email=dkim1f@earthlink.net', $output);
        $this->assertContains('first_name=Dorothy, last_name=Hughes, email=dhughes1g@noaa.gov', $output);
        $this->assertContains('first_name=Jimmy, last_name=Banks, email=jbanks1h@sohu.com', $output);
        $this->assertContains('first_name=Norma, last_name=Howell, email=nhowell1i@statcounter.com', $output);
        $this->assertContains('first_name=Anthony, last_name=Gardner, email=agardner1j@dailymail.co.uk', $output);
        $this->assertContains('first_name=Ruby, last_name=Cook, email=rcook1k@wix.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Rice, email=srice1l@huffingtonpost.com', $output);
        $this->assertContains('first_name=Marie, last_name=Webb, email=mwebb1m@cnbc.com', $output);
        $this->assertContains('first_name=Jesse, last_name=Hanson, email=jhanson1n@independent.co.uk', $output);
        $this->assertContains('first_name=Dorothy, last_name=Foster, email=dfoster1o@epa.gov', $output);
        $this->assertContains('first_name=Frank, last_name=Andrews, email=fandrews1p@nih.gov', $output);
        $this->assertContains('first_name=Ruby, last_name=Sanders, email=rsanders1q@diigo.com', $output);
        $this->assertContains('first_name=Peter, last_name=Frazier, email=pfrazier1r@istockphoto.com', $output);
        $this->assertContains('first_name=Sarah, last_name=Stephens, email=sstephens1s@imdb.com', $output);
        $this->assertContains('first_name=Gary, last_name=Pierce, email=gpierce1t@sphinn.com', $output);
        $this->assertContains('first_name=Alan, last_name=Lawson, email=alawson1u@cbc.ca', $output);
        $this->assertContains('first_name=Roger, last_name=Daniels, email=rdaniels1v@archive.org', $output);
        $this->assertContains('first_name=Marie, last_name=Cooper, email=mcooper1w@moonfruit.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Bryant, email=tbryant1x@intel.com', $output);
        $this->assertContains('first_name=Phillip, last_name=Owens, email=powens1y@lycos.com', $output);
        $this->assertContains('first_name=Jennifer, last_name=Barnes, email=jbarnes1z@myspace.com', $output);
        $this->assertContains('first_name=William, last_name=Shaw, email=wshaw20@sogou.com', $output);
        $this->assertContains('first_name=Kathryn, last_name=Montgomery, email=kmontgomery21@youku.com', $output);
        $this->assertContains('first_name=Frank, last_name=Cruz, email=fcruz22@mtv.com', $output);
        $this->assertContains('first_name=David, last_name=Woods, email=dwoods23@issuu.com', $output);
        $this->assertContains('first_name=Jose, last_name=Gonzales, email=jgonzales24@wufoo.com', $output);
        $this->assertContains('first_name=Clarence, last_name=Simmons, email=csimmons25@topsy.com', $output);
        $this->assertContains('first_name=Melissa, last_name=Ross, email=mross26@live.com', $output);
        $this->assertContains('first_name=Ernest, last_name=Kelly, email=ekelly27@hud.gov', $output);
        $this->assertContains('first_name=Eric, last_name=Rose, email=erose28@usgs.gov', $output);
        $this->assertContains('first_name=Denise, last_name=Gutierrez, email=dgutierrez29@4shared.com', $output);
        $this->assertContains('first_name=Lisa, last_name=Howard, email=lhoward2a@mozilla.org', $output);
        $this->assertContains('first_name=Kimberly, last_name=Hart, email=khart2b@tripadvisor.com', $output);
        $this->assertContains('first_name=Ronald, last_name=Elliott, email=relliott2c@sciencedaily.com', $output);
        $this->assertContains('first_name=Frank, last_name=Hernandez, email=fhernandez2d@about.com', $output);
        $this->assertContains('first_name=Judy, last_name=Austin, email=jaustin2e@google.de', $output);
        $this->assertContains('first_name=Jeffrey, last_name=Webb, email=jwebb2f@digg.com', $output);
        $this->assertContains('first_name=Jerry, last_name=Mcdonald, email=jmcdonald2g@reuters.com', $output);
        $this->assertContains('first_name=Shawn, last_name=Berry, email=sberry2h@auda.org.au', $output);
        $this->assertContains('first_name=Timothy, last_name=Carr, email=tcarr2i@mlb.com', $output);
        $this->assertContains('first_name=Kimberly, last_name=Lee, email=klee2j@paginegialle.it', $output);
        $this->assertContains('first_name=Cynthia, last_name=Brown, email=cbrown2k@aboutads.info', $output);
        $this->assertContains('first_name=Jessica, last_name=Morales, email=jmorales2l@webeden.co.uk', $output);
        $this->assertContains('first_name=Jane, last_name=Frazier, email=jfrazier2m@biblegateway.com', $output);
        $this->assertContains('first_name=Tammy, last_name=Hart, email=thart2n@friendfeed.com', $output);
        $this->assertContains('first_name=Chris, last_name=Dunn, email=cdunn2o@cornell.edu', $output);
        $this->assertContains('first_name=Dorothy, last_name=Barnes, email=dbarnes2p@marketwatch.com', $output);
        $this->assertContains('first_name=Arthur, last_name=King, email=aking2q@smh.com.au', $output);
        $this->assertContains('first_name=Jason2, last_name=Ross2, email=jross2r@desdev.cn', $output);

        // Finally verify that all users are in the database

        $users = $this->container
            ->get('doctrine')
            ->getRepository('AppBundle:User')
            ->findAll();

        // Kludge for the fact that the database may have 1 test user
        // Todo: Look at LoginHelpers and how to rollback user creation
        $this->assertEquals(count($users) == 100 || count($users) == 101, count($users));
    }

}