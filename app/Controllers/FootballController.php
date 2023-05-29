<?php

namespace App\Controllers;

use App\Models\SkorModel;
use App\Models\TeamModel;

class FootballController extends BaseController
{
    protected $teamModel;
    protected $skorModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->skorModel = new SkorModel();
    }
    public function index()
    {
        $teams = $this->teamModel->findAll();

        $data = [
            'teams' => $teams
        ];

        return view('football/index', $data);
    }

    public function addTeam()
    {
        session();
        return view('football/add_team');
    }

    public function saveTeam()
    {
        if (!$this->validate([
            'nama_klub' => 'required|is_unique[teams.nama_klub]',
            'kota_klub' => 'required',
        ], [
            'nama_klub' => [
                'required' => ' Nama Klub harus di isi.',
                'is_unique' => ' Nama Klub sudah ada.'
            ],
            'kota_klub' => [
                'required' => ' Kota Klub harus di isi.'
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/football/addTeam')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_klub' => $this->request->getPost('nama_klub'),
            'kota_klub' => $this->request->getPost('kota_klub'),
            'played' => 0,
            'won' => 0,
            'drawn' => 0,
            'lost' => 0,
            'goals_for' => 0,
            'goals_against' => 0,
            'point' => 0
        ];

        $this->teamModel->insert($data);

        return redirect()->to('/football');
    }

    public function addScore()
    {
        session();
        $teams = $this->teamModel->findAll();

        $data = [
            'teams' => $teams
        ];

        return view('football/add_score', $data);
    }

    public function saveScore()
    {
        $homeTeamId = $this->request->getPost('home_team'); //1
        $awayTeamId = $this->request->getPost('away_team'); //2
        $homeTeamScore = $this->request->getPost('home_team_score');
        $awayTeamScore = $this->request->getPost('away_team_score');

        $existingMatch = $this->skorModel->where('id_klub1', $homeTeamId)->where('id_klub2', $awayTeamId)->countAllResults();
        if ($existingMatch > 0) {
            return redirect()->to('/football/addScore')->with('error', 'Pertandingan tersebut sudah ada dalam sistem.');
        }

        if ($homeTeamId == $awayTeamId) {
            return redirect()->to('/football/addScore')->with('error', 'Tim yang di input harus berbeda yahh');
        }

        $data = [
            'id_klub1' => $homeTeamId,
            'id_klub2' => $awayTeamId,
            'skor1' => $homeTeamScore,
            'skor2' => $awayTeamScore,
        ];
        $this->skorModel->save($data);

        $homeTeam = $this->teamModel->find($homeTeamId);
        $awayTeam = $this->teamModel->find($awayTeamId);

        $homeTeam['played']++;
        $awayTeam['played']++;

        $homeTeam['goals_for'] += $homeTeamScore;
        $homeTeam['goals_against'] += $awayTeamScore;

        $awayTeam['goals_for'] += $awayTeamScore;
        $awayTeam['goals_against'] += $homeTeamScore;

        if ($homeTeamScore > $awayTeamScore) {
            $homeTeam['won']++;
            $awayTeam['lost']++;
        } elseif ($homeTeamScore < $awayTeamScore) {
            $homeTeam['lost']++;
            $awayTeam['won']++;
        } else {
            $homeTeam['drawn']++;
            $awayTeam['drawn']++;
        }

        $homeTeam['point'] = ($homeTeam['won'] * 3) + $homeTeam['drawn'];
        $awayTeam['point'] = ($awayTeam['won'] * 3) + $awayTeam['drawn'];

        $this->teamModel->save($homeTeam);
        $this->teamModel->save($awayTeam);

        return redirect()->to('/football');
    }
}
