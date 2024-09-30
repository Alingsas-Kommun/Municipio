@if ($posts)
    <div class="o-grid">
        @foreach ($posts as $key => $post)
             <div class="{{ $gridColumnClass }}">
                @card([
                    'image' => $post->images['thumbnail16:9'],
                    'link' => $post->permalink,
                    'imageFirst' => true,
                    'heading' => $post->postTitle,
                    'metaFirst' => true,
                    'meta' =>  !empty($post->projectTerms['category']) ? implode('/ ', $post->projectTerms['category']) : '',
                    'context' => ['archive', 'archive.list', 'archive.list.card'],
                    'containerAware' => true,
                    'content' => !empty($post->projectTerms['technology']) ? implode('/ ', $post->projectTerms['technology']) : '',
                    'hasPlaceholder' => $anyPostHasImage && empty($post->images['thumbnail16:9']['src']),
                    'classList' => ['u-height--100']
                ])  
                    @slot('afterContent')
                        @if(isset($post->progress))
                            @group([
                                'direction' => 'vertical',
                                'justifyContent' => 'flex-end',
                                'classList' => ['u-height--100']
                            ])
                                @if(isset($post->projectTerms['status'][0]))
                                    @typography([
                                        'element' => 'b',
                                        'classList' => ['u-margin__left--auto']
                                    ])
                                        {{$post->projectTerms['status'][0]}}
                                    @endtypography
                                @endif
                                @progressBar([
                                    'value' => $post->progress,
                                ])
                                @endprogressBar
                            @endgroup
                        @endif
                    @endslot
                @endcard
            </div>
        @endforeach
    </div>
@endif