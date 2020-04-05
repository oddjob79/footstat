<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class StatsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function show($teamname)
  {
    // $teamname = 'Tottenham';
    // $arr = array('team'=>$teamname);
    // $json = json_encode($arr);

    // $process = new Process('/vagrant/Projects/footstat/ext/exec_py.sh {$json}');
    $process = new Process("/vagrant/Projects/footstat/ext/exec_py.sh \"{$teamname}\"");
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }

    // return dump(json_decode($process->getOutput(), true));
    return $process->getOutput();
  }

}
