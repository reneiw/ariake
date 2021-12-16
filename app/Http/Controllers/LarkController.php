<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LarkController extends Controller
{
    public function __invoke(Request $request, $lark)
    {
        $data = $request->all();

        $post = [
            'title' => $data['project']['path_with_namespace'],
            'content' => [
                [
                    [
                        'tag' => 'text',
                        'un_escape' => true,
                        'text' => '项目&nbsp;:'
                    ],
                    [
                        'tag' => 'a',
                        'text' => $data['project']['path_with_namespace'],
                        'href' => $data['project']['homepage'] ?? $data['project']['web_url'],
                    ]
                ],
            ]
        ];

        switch (true) {
            case $data['object_kind'] === 'release':
                $post['title'] .= '发布版本';

                $post['content'][] = [
                    [
                        'tag' => 'text',
                        'un_escape' => true,
                        'text' => '版本号&nbsp;:'
                    ],
                    [
                        'tag' => 'a',
                        'text' => $data['name'],
                        'href' => $data['url'],
                    ]
                ];
                break;
            case $data['object_kind'] === 'pipeline' && ($data['merge_request']['state'] ?? 'null' === 'open'):
                $post['title'] .= '合并请求';
                $post['content'][] = [
                    [
                        'tag' => 'text',
                        'un_escape' => true,
                        'text' => '合并标题&nbsp;:'
                    ],
                    [
                        'tag' => 'a',
                        'text' => $data['merge_request']['title'],
                        'href' => $data['merge_request']['url'],
                    ]
                ];

                $post['content'][] = [
                    [
                        'tag' => 'text',
                        'un_escape' => true,
                        'text' => '合并分支&nbsp;:'
                    ],
                    [
                        'tag' => 'a',
                        'text' => $data['merge_request']['source_branch'] . ' => ' . $data['merge_request']['target_branch'],
                        'href' => $data['merge_request']['url'],
                    ]
                ];
                if ($data['user']['name'] ?? false) {
                    $post['content'][] = [
                        [
                            'tag' => 'text',
                            'un_escape' => true,
                            'text' => '处理人&nbsp;:'
                        ],
                        [
                            'tag' => 'text',
                            'text' => $data['user']['name'] . '等其他相关人士',
                        ]
                    ];
                }
        }

        Http::baseUrl('https://open.feishu.cn/open-apis/bot/v2/hook/')
            ->asJson()
            ->post(
                $lark,
                [
                    'msg_type' => 'post',
                    'content' => [
                        'post' => [
                            'zh_cn' => $post
                        ]
                    ]
                ]
            );
    }
}
