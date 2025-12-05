window.vote = async function(reviewId, value) {
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!csrfToken) {
        console.error('CSRF Token not found!');
        return;
    }

    try {
        const response = await fetch(`/reviews/${reviewId}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ value: value })
        });

        if (response.status === 401) {
            window.location.href = "/login"; 
            return;
        }

        if (!response.ok) {
            const data = await response.json();
            alert(data.message || 'Gagal melakukan voting');
            return;
        }

        const data = await response.json();
        
        const container = document.querySelector(`.vote-container[data-review-id="${reviewId}"]`);
        if (container) {
            container.querySelector('.vote-score').textContent = data.score;

            const upBtn = container.querySelector('.upvote');
            const downBtn = container.querySelector('.downvote');

            upBtn.classList.remove('text-warning', 'text-muted');
            downBtn.classList.remove('text-danger', 'text-muted');

            if (data.current_user_vote === 1) {
                upBtn.classList.add('text-warning');
                downBtn.classList.add('text-muted');
            } else if (data.current_user_vote === -1) {
                upBtn.classList.add('text-muted');
                downBtn.classList.add('text-danger');
            } else {
                upBtn.classList.add('text-muted');
                downBtn.classList.add('text-muted');
            }
        }

    } catch (error) {
        console.error('Error:', error);
    }
};