
FROM gitpod/workspace-full

# Install additional dependencies if needed
USER root

# Copy bob application
COPY /app/bob /app/bob

# Set permissions
RUN chmod +x /app/bob

USER gitpod